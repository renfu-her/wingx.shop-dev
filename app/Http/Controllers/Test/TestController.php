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
    public function queryOrderStatus()
    {
        Log::info('=== Test 訂單狀態更新 Log ' . date('Y-m-d H:i:s') . ' ===');
        $orders = Order::whereIn('status', [0, 9])->get();
        $paymentConfig = config('ecpay.payment');
        $url = $paymentConfig['query_trade_info_url'];
        $merchantId = $paymentConfig['merchant_id'];
        $hashKey = $paymentConfig['hash_key'];
        $hashIv = $paymentConfig['hash_iv'];
        foreach ($orders as $key => $value) {

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

            if ($orderStatusArray['TradeStatus'] == 1) {
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
        $order = Order::where('pay_logistics_id', '!=', null)->get();
        $logisticsConfig = config('ecpay.logistics');
        $logisticsUrl = $logisticsConfig['query_url'];
        $merchantId = $logisticsConfig['merchant_id'];
        $hashKey = $logisticsConfig['hash_key'];
        $hashIV = $logisticsConfig['hash_iv'];

        foreach ($order as $key => $value) {
            $logisticsData = [
                'MerchantID' => $merchantId,
                "AllPayLogisticsID" => $value['pay_logistics_id'],
                "TimeStamp" => Carbon::now()->timestamp,
            ];

            $checkMacValue = $this->checkMacValue($logisticsData, $hashKey, $hashIV);

            $logisticsData['CheckMacValue'] = $checkMacValue;

            $logistics = Http::asForm()->post($logisticsUrl, $logisticsData);

            $logisticsArray = [];
            parse_str($logistics->body(), $logisticsArray);

            if (empty($logisticsArray['LogisticsStatus'])) {
                Log::warning('Test 物流狀態查詢缺少 LogisticsStatus', [
                    'order_no' => $value['order_no'] ?? null,
                    'pay_logistics_id' => $value['pay_logistics_id'] ?? null,
                    'response' => $logistics->body(),
                ]);
                continue;
            }

            $logisticsStatus = LogisticsStatus::where('code', $logisticsArray['LogisticsStatus'])->first();
            $logisticsArray['LogisticsStatusName'] = $logisticsStatus->message ?? null;

            $orderData = Order::where('pay_logistics_id', $value['pay_logistics_id'])->first();
            $orderData->logistics_status = $logisticsArray['LogisticsStatus'];
            $orderData->save();
        }
        Log::info('=== 物流訂單狀態更新完成 ===');
    }


    // 檢查電子發票
    public function eInvoice(Request $request, $order_no)
    {

        $ecpayService = new EcPayService();
        $eInvoice = $ecpayService->ecpayInvoice($order_no);

        if ($eInvoice['TransCode'] == 1) {

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

        foreach ($products as $product) {

            $product_id = $product['id'];

            foreach ($ships as $ship) {
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

    // 檢查載具編號
    
    public function checkCarrierNum(Request $request)
    {
        $invoiceConfig = config('ecpay.invoice');
        $url = $invoiceConfig['check_barcode_url'];
        $merchantId = $invoiceConfig['merchant_id'];
        $hashKey = $invoiceConfig['hash_key'];
        $hashIV = $invoiceConfig['hash_iv'];

        $data = [
            'MerchantID' => $merchantId,
            'BarCode' => $request['barCode'],
        ];

        $encryptedData = $this->encryptECPay(json_encode($data), $hashKey, $hashIV);


        $requestData = [
            'MerchantID' => $merchantId,
            'RqHeader' => [
                'Timestamp' => time(),
                'Revision' => '1.0.0',
            ],
            'Data' => $encryptedData,
        ];

        $response = Http::post($url, $requestData)->json();


        if (isset($response['Data'])) {
            $decryptedData = $this->decryptECPay($response['Data'], $hashKey, $hashIV);
            $resultData = json_decode($decryptedData, true);

            return response()->json($resultData);
        }

    }

    private function encryptECPay($data, $hashKey, $hashIV)
    {
        $data = urlencode($data);
        $cipher = "aes-128-cbc";
        $options = OPENSSL_RAW_DATA;
        $encrypted = openssl_encrypt($data, $cipher, $hashKey, $options, $hashIV);
        return base64_encode($encrypted);
    }

    private function decryptECPay($encryptedData, $hashKey, $hashIV)
    {
        $cipher = "aes-128-cbc";
        $options = OPENSSL_RAW_DATA;
        $decoded = base64_decode($encryptedData);
        $decrypted = openssl_decrypt($decoded, $cipher, $hashKey, $options, $hashIV);
        return urldecode($decrypted);
    }
}
