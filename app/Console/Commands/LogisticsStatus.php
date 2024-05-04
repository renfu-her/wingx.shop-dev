<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TsaiYiHua\ECPay\QueryTradeInfo;
use Illuminate\Support\Facades\Http;

use App\Models\Order;
use Carbon\Carbon;

class LogisticsStatus extends Command
{

    protected $signature = 'LogisticsStatus';
    protected $description = '物流狀態更新';

    // 訂單狀態更新
    public function handle()
    {
        Log::info('=== 物流訂單狀態更新 ' . date('Y-m-d H:i:s') . ' ===');
        $order = Order::where('pay_logistics_id', '!=', null)->get();

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
            // dd($logisticsStatus, $logisticsArray);
            $logisticsArray['LogisticsStatusName'] = $logisticsStatus->message;

            $orderData = Order::where('pay_logistics_id', $value['pay_logistics_id'])->first();
            $orderData->logistics_status = $logisticsArray['LogisticsStatus'];
            $orderData->save();
        }
        Log::info('=== 物流訂單狀態更新完成 ===');
    }


    // 檢查碼
    public function checkMacValue(array $params, $hashKey, $hashIV, $encType = 1)
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

        // dd($paramsString);

        // 6) 轉為全小寫
        $paramsString = strtolower($paramsString);

        // 7) 轉換特定字元(與 dotNet 相符的字元)
        $search  = ['%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29'];
        $replace = ['-',   '_',   '.',   '!',   '*',   '(',   ')'];
        $paramsString = str_replace($search, $replace, $paramsString);

        // 8) 進行編碼
        // dd(md5($paramsString));
        // $paramsString = $encType ? hash('sha256', $paramsString) : md5($paramsString);
        $paramsString = md5($paramsString);

        // 9) 轉為全大寫後回傳
        return strtoupper($paramsString);
    }
}
