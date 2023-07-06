<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\Order;
use App\Services\EcPayService;

class InvoiceCheck extends Command
{

    protected $signature = 'InvoiceCheck';
    protected $description = '檢查發票是否開立成功';

    public function handle()
    {

        $orders = Order::where('status', 1)->where('invoice_no', '')->get();
        Log::info('=== 發票 Start ==');
        foreach($orders as $key => $value){
            $ecpayService = new EcPayService();
            $eInvoice = $ecpayService->ecpayInvoice($value->order_no);

            if($eInvoice['TransCode'] == 1){

                $e_invoice = $eInvoice['Data'];
                $invoiceNo = $e_invoice['InvoiceNumber'] ?? $e_invoice['InvoiceNo'];
                $order = Order::where('order_no', $value->order_no)->first();
                $order->invoice_no = $invoiceNo;
                $order->invoice_random_no = $e_invoice['RandomNumber'];
                $order->save();

                Log::info('=== 發票成功 : ' . $invoiceNo . ' ==');
            };
        }
        Log::info('=== 發票 End ==');
    }
}
