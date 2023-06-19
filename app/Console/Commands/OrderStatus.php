<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\Order;

class OrderStatus extends Command
{

    protected $signature = 'OrderStatus';
    protected $description = '訂單狀態更新';

    // 訂單狀態更新
    public function handle()
    {

        Log::info('=== 訂單狀態更新 Log ' . date('Y-m-d H:i:s') . ' ===');
        $orders = Order::whereIn('status', [0, 9])->get();
        foreach ($orders as $key => $value) {

            $amt = $value['total'] + $value['ship_price'];
            $mno = $value['order_no'];
            $mid = env("NEWEBPAY_MERCHANT_ID");
            $check_value = $this->check_value($amt, $mno);

            $url = "https://core.newebpay.com/API/QueryTradeInfo";
            if (env('APP_ENV') == 'dev') {
                $url = "https://ccore.newebpay.com/API/QueryTradeInfo";
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
                array(
                    "Version" => "1.3", "MerchantID" => $mid, "RespondType" => "JSON",
                    "CheckValue" => $check_value, "TimeStamp" => time(),
                    "MerchantOrderNo" => $value['order_no'], "Amt" => $amt
                )
            ));
            $output = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($output, true);
            if($result['Status'] == 'SUCCESS'){
                $res = $result['Result'];
                $orderStatus = $res['TradeStatus'];
                // 更新訂單狀態
                Log::info('=== 訂單狀態更新 MerchantOrderNo: ' . $res['MerchantOrderNo'] . ' ===');
                Order::where('order_no', $res['MerchantOrderNo'])->update(['status' => $orderStatus]);

            }
        }
        Log::info('=== 訂單狀態更新完成 ===');
    }

    // check value
    public function check_value($amt, $mno)
    {
        $mid = env("NEWEBPAY_MERCHANT_ID");
        $key = env("NEWEBPAY_HASH_KEY");
        $iv = env("NEWEBPAY_HASH_IV");

        $data1 = http_build_query(array(
            'Amt' => $amt,
            'MerchantID' => $mid,
            'MerchantOrderNo' => $mno
        ));
        $hashs = "IV=" . $iv . "&" . $data1 . "&Key=" . $key;
        $hash = strtoupper(hash("sha256", $hashs));

        return $hash;
    }
}