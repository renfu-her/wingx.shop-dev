<?php

namespace App\Services;

use App\Services\BaseService;

use Illuminate\Support\Facades\Http;
use Ecpay\Sdk\Factories\Factory;

use App\Models\Order;

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

        $factory = new Factory([
            'hashKey' => $hashKey,
            'hashIv' => $hashIV,
        ]);

        $postService = $factory->create('PostWithAesJsonResponseService');

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

        $data['Items'] = [
            [
                'ItemName' => '商品',
                'ItemCount' => 1,
                'ItemWord' => '個',
                'ItemPrice' => $order_price,
                'ItemTaxType' => 1,
                'ItemAmount' => $order_price,
                'ItemRemark' => '',
            ],
        ];

        dd($data);

        $input = [
            'MerchantID' => $merchantId,
            'RqHeader' => [
                'Timestamp' => time(),
                'Revision' => '1.0.0',
            ],
            'Data' => $data,
        ];

        $response = $postService->post($input, $url);
        var_dump($response);

    }

}
