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


        // $factory = new Factory([
        //     'hashKey' => $hashKey,
        //     'hashIv' => $hashIV,
        // ]);

        // $postService = $factory->create('PostWithAesJsonResponseService');

        // $order = Order::where('order_no', $order_no)->first();

        // $order_price = $order->amount + $order->tax;

        // $data = [
        //     'MerchantID' => $merchantId,
        //     'RelateNumber' => 'INV-' . date('YmdHis'),
        //     'CustomerID' => '',
        //     'CustomerAddr' => $order->company_address,
        //     'CustomerPhone' => $order->mobile,
        //     'CustomerEmail' => $order->email,
        //     "ClearanceMark" => "1",
        //     "Print" => "1",
        //     'Donation' => "0",
        //     'LoveCode' => '',
        //     'CarrierType' => '',
        //     'CarrierNum' => '',
        //     'TaxType' => 1,
        //     'SalesAmount' => (int)$order_price,
        //     'InvType' => '07',
        //     'vat' => 1,
        // ];

        // if(!empty($order->company_uid)){
        //     $data['CustomerIdentifier'] = $order->company_id;
        //     $data['CustomerName'] = $order->company_name;
        // } else {
        //     $data["CustomerIdentifier"] = "";
        //     $data['CustomerName'] = $order->name;
        // }

        // $data['Items'] = [
        //     [
        //         'ItemSeq' => 1,
        //         'ItemName' => '商品',
        //         'ItemCount' => 1,
        //         'ItemWord' => '個',
        //         'ItemPrice' => $order_price,
        //         'ItemTaxType' => 1,
        //         'ItemAmount' => $order_price,
        //         'ItemRemark' => '',
        //     ],
        // ];

        // $itemCount = 1;
        // $itemPriceIncludeTax = 100;
        // $itemAmount = round(($itemPriceIncludeTax * $itemCount), 0);
        // $saleAmount = $itemAmount;

        // $data = [
        //     'MerchantID' => $merchantId,
        //     'RelateNumber' => 'Test' . time(),
        //     'CustomerPhone' => '0911222333',
        //     'Print' => '0',
        //     'Donation' => '0',
        //     'CarrierType' => '1',
        //     'TaxType' => '1',
        //     'SalesAmount' => $saleAmount,
        //     'Items' => [
        //         [
        //             'ItemName' => '測試商品01',
        //             'ItemCount' => $itemCount,
        //             'ItemWord' => '個',
        //             'ItemPrice' => $itemPriceIncludeTax,
        //             'ItemTaxType' => '1',
        //             'ItemAmount' => $itemAmount,
        //         ],
        //     ],
        //     'InvType' => '07'
        // ];


        // $input = [
        //     'MerchantID' => $merchantId,
        //     'RqHeader' => [
        //         'Timestamp' => time(),
        //         'Revision' => '3.0.0',
        //     ],
        //     'Data' => $data,
        // ];

        // dd($input, $data, $merchantId, $hashKey, $hashIV, $url);

        $factory = new Factory([
            'hashKey' => 'ejCk326UnaZWKisg',
            'hashIv' => 'q9jcZX8Ib9LM8wYk',
        ]);
        $postService = $factory->create('PostWithAesJsonResponseService');

        $itemCount = 3;
        $itemPriceIncludeTax = 100;
        $itemAmount = round(($itemPriceIncludeTax * $itemCount), 0);
        $saleAmount = $itemAmount;
        $data = [
            'MerchantID' => '2000132',
            'RelateNumber' => 'INV-' . time(),
            'CustomerPhone' => '0911222333',
            'Print' => '0',
            'Donation' => '0',
            'CarrierType' => '1',
            'TaxType' => '1',
            'SalesAmount' => $saleAmount,
            'Items' => [
                [
                    'ItemName' => '商品',
                    'ItemCount' => $itemCount,
                    'ItemWord' => '個',
                    'ItemPrice' => $itemPriceIncludeTax,
                    'ItemTaxType' => '1',
                    'ItemAmount' => $itemAmount,
                ],
            ],
            'InvType' => '07'
        ];
        $input = [
            'MerchantID' => '2000132',
            'RqHeader' => [
                'Timestamp' => time(),
                'Revision' => '3.0.0',
            ],
            'Data' => $data,
        ];
        $url = 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue';

        dd($data, $input, $url);

        $response = $postService->post($input, $url);
        var_dump($response);

    }

}
