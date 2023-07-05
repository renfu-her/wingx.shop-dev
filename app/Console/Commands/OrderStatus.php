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
