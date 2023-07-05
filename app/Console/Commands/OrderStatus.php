<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TsaiYiHua\ECPay\QueryTradeInfo;
use Illuminate\Support\Facades\Http;

use App\Models\Order;

class OrderStatus extends Command
{

    protected $signature = 'OrderStatus';
    protected $description = '訂單狀態更新';

    // 訂單狀態更新
    public function handle()
    {

        Log::info('=== 訂單狀態更新 ' . date('Y-m-d H:i:s') . ' ===');
        $orders = Order::whereIn('status', [0, 9])->get();
        foreach ($orders as $key => $value) {

            if(config('config.APP_ENV') == 'dev'){
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
        Log::info('=== 訂單狀態更新完成 ===');
    }


}
