<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

/**
 * Class EcPayService
 * @package App\Services
 */
class EcPayService extends BaseService
{

    public function ecpayInvoice($order_no)
    {
        if(config('config.APP_ENV') == 'dev'){
            $url = "https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue";
            $merchantId = config('config.INVOICE_ID_DEV');
            $hashKey = config('config.INVOICE_HASH_KEY_DEV');
            $hashIV = config('config.INVOCE_HASH_IV_DEV');
        } else {
            $url = "https://einvoice.ecpay.com.tw/B2CInvoice/Issue";
            $merchantId = config('config.INVOICE_ID');
            $hashKey = config('config.INVOICE_HASH_KEY');
            $hashIV = config('config.INVOCE_HASH_IV');
        }

        $order = Order::where('order_no', $order_no)->first();

        $order_price = $order->amount + $order->tax;

        $data = [
            'MerchantID' => $merchantId,
            'RelateNumber' => 'INV-' . date('YmdHis'),
            'CustomerID' => '',
            'CustomerAddr' => $order->company_address,
            'CustomerPhone' => $order->mobile,
            'CustomerEmail' => $order->email,
            'Donation' => 0,
            'CarrierType' => '',
            'CarrierNum' => '',
            'TaxType' => 1,
            'SalesAmount' => $order_price,
            'InvType' => '07',
            'vat' => 1,
        ];

        if(!empty($order->company_uid)){
            $data['CustomerIdentifier'] = $order->company_id;
            $data['CustomerName'] = $order->company_name;
            $data['Print'] = 1;
        } else {
            $data['CustomerName'] = $order->name;
            $data['Print'] = 0;
        }

        $data_str = urlencode(json_encode($data));

        $cipher = "AES-128-CBC";
        $encrypted = base64_encode(openssl_encrypt($data_str,
                $cipher, $hashKey, OPENSSL_RAW_DATA, $hashIV));

        $invoice = Http::post($url, [
            'MerchantID' => $merchantId,
            'RqHeader' => [
                'Timestamp' => time(),
                'Revision' => '3.0.0',
            ],
            'Data' => strtoupper($encrypted),
        ]);

        dd($invoice->body(), $data_str, $encrypted);

    }

}