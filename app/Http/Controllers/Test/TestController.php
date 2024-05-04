<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TsaiYiHua\ECPay\QueryTradeInfo;
use Illuminate\Support\Facades\Http;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderShip;
use App\Models\Ship;
use App\Models\Product;
use App\Models\ProductShip;
use App\Models\LogisticsStatus;

use App\Services\EcPayService;
use Carbon\Carbon;

class TestController extends Controller
{
    // 檢查訂單狀態
    public function queryOrderStatus(){
        Log::info('=== Test 訂單狀態更新 Log ' . date('Y-m-d H:i:s') . ' ===');
        $orders = Order::whereIn('status', [0, 9])->get();
        foreach ($orders as $key => $value) {

            if(config('config.APP_ENV') == 'local'){
                $url = 'https://payment-stage.ecpay.com.tw/Cashier/QueryTradeInfo/V5';
                $merchantId = config('config.ECPAY_MERCHANT_ID_DEV');
                $hashKey = config('config.ECPAY_HASH_KEY_DEV');
                $hashIv = config('config.ECPAY_HASH_IV_DEV');
            } else {
                $url = 'https://payment.ecpay.com.tw/Cashier/QueryTradeInfo/V5';
                $merchantId = config('config.ECPAY_MERCHANT_ID');
                $hashKey = config('config.ECPAY_HASH_KEY');
                $hashIv = config('config.ECPAY_HASH_IV');
            }

            $checkMacValue = $this->ecpayCheckMacValue([
                'MerchantID' => $merchantId,
                'MerchantTradeNo' => $value->order_no,
                'TimeStamp' => time(),
            ], $hashKey, $hashIv);

            $status = Http::post($url, [
                'MerchantID' => $merchantId,
                'MerchantTradeNo' => $value->order_no,
                'TimeStamp' => time(),
                'CheckMacValue' => $checkMacValue,
            ]);

            parse_str($status->body(), $orderStatusArray);

            if($orderStatusArray['TradeStatus'] == 1){
                $order = Order::where('order_no', $value->order_no)->first();
                $order->status = 1;
                $order->save();
            }

            Log::info('= order status start =');
            Log::info('merchant id: ' . $merchantId);
            Log::info('order no: ' . $value->order_no);
            Log::info('status: ' . $orderStatusArray['TradeStatus']);
            Log::info('= order status end =');
            sleep(5);

        }
        Log::info('=== Test 訂單狀態更新完成 ===');
    }

    public function getLogisticsStatus()
    {

        Log::info('=== 物流訂單狀態更新 ' . date('Y-m-d H:i:s') . ' ===');
        $order = Order::where('pay_logistics_id', '!=', null)->first();

        if (config('config.APP_ENV') == 'local') {
            $logisticsUrl = config('config.EXPRESS_LOGISTICS_DEV');
            $merchantId = config('config.EXPRESS_MERCHANT_ID_DEV');
        } else {
            $logisticsUrl = config('config.EXPRESS_LOGISTICS');
            $merchantId = config('config.EXPRESS_MERCHANT_ID');
        }

        foreach ($order as $key => $value) {
            $logisticsData = [
                'MerchantID' => $merchantId,
                "AllPayLogisticsID" => $value['pay_logistics_id'],
                "TimeStamp" => Carbon::now()->timestamp,
            ];

            if (config('config.APP_ENV') == 'local') {
                $checkMacValue = $this->checkMacValue($logisticsData, config('config.EXPRESS_HASH_KEY_DEV'), config('config.EXPRESS_HASH_IV_DEV'));
            } else {
                $checkMacValue = $this->checkMacValue($logisticsData, config('config.EXPRESS_HASH_KEY'), config('config.EXPRESS_HASH_IV'));
            }

            $logisticsData['CheckMacValue'] = $checkMacValue;

            $logistics = Http::asForm()->post($logisticsUrl, $logisticsData);

            $logisticsArray = [];
            parse_str($logistics, $logisticsArray);

            $logisticsStatus = LogisticsStatus::where('code', $logisticsArray['LogisticsStatus'])->first();
            $logisticsArray['LogisticsStatusName'] = $logisticsStatus->message;

            $orderData = Order::where('pay_logistics_id', $value['pay_logistics_id'])->first();
            if($logisticsArray['LogisticsStatus'] == 2){
                $orderData->logistics_status = 2;
                $orderData->save();
            }
        }
        Log::info('=== 物流訂單狀態更新完成 ===');
    }


    // 檢查電子發票
    public function eInvoice(Request $request, $order_no){

        $ecpayService = new EcPayService();
        $eInvoice = $ecpayService->ecpayInvoice($order_no);

        if($eInvoice['TransCode'] == 1){

            $e_invoice = $eInvoice['Data'];

            $order = Order::where('order_no', $order_no)->first();
            $order->invoice_no = $e_invoice['InvoiceNumber'] ?? $e_invoice['InvoiceNo'];
            $order->invoice_random_no = $e_invoice['RandomNumber'];
            $order->save();
        };

    }

    // ships to order_ships
    public function shipToProductShip()
    {

        $products = Product::all();

        $ships = Ship::all();

        foreach($products as $product){

            $product_id = $product['id'];

            foreach($ships as $ship){
                $createOrderShip = [
                    'product_id' => $product_id,
                    'ship_id' => $ship['id'],
                    'price' => $ship['ship_price'],
                    'status' => 1
                ];
                ProductShip::create($createOrderShip);                
            }

        }

    }

}
