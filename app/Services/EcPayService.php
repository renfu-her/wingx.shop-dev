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
            "ClearanceMark" => "1",
            "Print" => "1",
            'Donation' => "0",
            'LoveCode' => '',
            'CarrierType' => '',
            'CarrierNum' => '',
            'TaxType' => 1,
            'SalesAmount' => (int)$order_price,
            'InvType' => '07',
            'vat' => 1,
        ];

        if(!empty($order->company_uid)){
            $data['CustomerIdentifier'] = $order->company_id;
            $data['CustomerName'] = $order->company_name;
        } else {
            $data["CustomerIdentifier"] = "";
            $data['CustomerName'] = $order->name;
        }

        $data['Items'] = [
            [
                'ItemSeq' => 1,
                'ItemName' => '商品',
                'ItemCount' => 1,
                'ItemWord' => '個',
                'ItemPrice' => $order_price,
                'ItemTaxType' => 1,
                'ItemAmount' => $order_price,
                'ItemRemark' => '',
            ],
        ];


        $data = [
            "MerchantID" => $merchantId,
            "RelateNumber" => 'INV-' . date('YmdHis'),
            "CustomerID" => "",
            "CustomerIdentifier" => "",
            "CustomerName" => "綠界科技股份有限公司",
            "CustomerAddr" => "106台北市南港區發票一街1號1樓",
            "CustomerPhone" => "",
            "CustomerEmail" => "test@ecpay.com.tw",
            "ClearanceMark" => "1",
            "Print" => "1",
            "Donation" => "0",
            "LoveCode" => "",
            "CarrierType" => "",
            "CarrierNum" => "",
            "TaxType" => "1",
            "SalesAmount" => 100,
            "InvoiceRemark" => "發票備註",
            "InvType" => "07",
            "vat" => "1",
            "Items" => [
                  [
                     "ItemSeq" => 1,
                     "ItemName" => "item01",
                     "ItemCount" => 1,
                     "ItemWord" => "件",
                     "ItemPrice" => 50,
                     "ItemTaxType" => "1",
                     "ItemAmount" => 50,
                     "ItemRemark" => "item01_desc"
                  ],
                  [
                        "ItemSeq" => 2,
                        "ItemName" => "item02",
                        "ItemCount" => 1,
                        "ItemWord" => "個",
                        "ItemPrice" => 20,
                        "ItemTaxType" => "1",
                        "ItemAmount" => 20,
                        "ItemRemark" => "item02_desc"
                     ],
                  [
                           "ItemSeq" => 3,
                           "ItemName" => "item03",
                           "ItemCount" => 3,
                           "ItemWord" => "粒",
                           "ItemPrice" => 10,
                           "ItemTaxType" => "1",
                           "ItemAmount" => 30,
                           "ItemRemark" => "item03_desc"
                        ]
               ]
         ];



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
