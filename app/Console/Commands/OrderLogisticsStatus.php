<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\Order;
use App\Services\EcPayService;

class OrderLogisticsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:order-logistics-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::whereIn('logistics_status', [2067, 3022])
            ->whereNull('invoice_no')
            ->get();

        Log::info($orders);

        Log::info('=== 物流發票 Start ==');
        foreach ($orders as $order) {
            $ecpayService = new EcPayService();
            $eInvoice = $ecpayService->ecpayInvoice($order->order_no);

            Log::info('=== 物流發票 : ' . $order->order_no);
            Log::info($eInvoice);
            if ($eInvoice['TransCode'] == 1) {
                $e_invoice = $eInvoice['Data'];
                $invoiceNo = $e_invoice['InvoiceNumber'] ?? $e_invoice['InvoiceNo'];
                $order = Order::where('order_no', $order->order_no)->first();
                $order->invoice_no = $invoiceNo;
                $order->invoice_random_no = $e_invoice['RandomNumber'];
                $order->status = 1;
                $order->save();

                Log::info('=== 物流發票成功 : ' . $invoiceNo . ' ==');
            };
            sleep(2);
        }
        Log::info('=== 物流發票 End ==');
    }
}
