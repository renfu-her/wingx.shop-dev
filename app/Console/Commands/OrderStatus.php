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

            if (config('config.APP_ENV') == 'dev') {
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
        Log::info('=== 訂單狀態更新完成 ===');
    }


    /**
     * 綠界檢查碼產生器
     *
     * @author Liao San Kai
     * @param array $params 表單資料
     * @param string $hashKey hashKey
     * @param string $hashIV hashIV
     * @param int $encType 編碼方式 (1=sha256, 0=md5)
     * @return string
     */
    function ecpayCheckMacValue(array $params, $hashKey, $hashIV, $encType = 1)
    {
        // 0) 如果資料中有 null，必需轉成空字串
        $params = array_map('strval', $params);

        // 1) 如果資料中有 CheckMacValue 必需先移除
        unset($params['CheckMacValue']);

        // 2) 將鍵值由 A-Z 排序
        uksort($params, 'strcasecmp');

        // 3) 將陣列轉為 query 字串
        $paramsString = urldecode(http_build_query($params));

        // 4) 最前方加入 HashKey，最後方加入 HashIV
        $paramsString = "HashKey={$hashKey}&{$paramsString}&HashIV={$hashIV}";

        // 5) 做 URLEncode
        $paramsString = urlencode($paramsString);

        // 6) 轉為全小寫
        $paramsString = strtolower($paramsString);

        // 7) 轉換特定字元(與 dotNet 相符的字元)
        $search  = ['%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29'];
        $replace = ['-',   '_',   '.',   '!',   '*',   '(',   ')'];
        $paramsString = str_replace($search, $replace, $paramsString);

        // 8) 進行編碼
        $paramsString = $encType ? hash('sha256', $paramsString) : md5($paramsString);

        // 9) 轉為全大寫後回傳
        return strtoupper($paramsString);
    }
}
