<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TsaiYiHua\ECPay\QueryTradeInfo;

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

            // $order_status = (new QueryTradeInfo())->getData($value->order_no)->query();
            // Log::info($order_status);
            sleep(5);
        }
        Log::info('=== 訂單狀態更新完成 ===');
    }


}
