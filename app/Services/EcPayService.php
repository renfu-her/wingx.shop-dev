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

        if($order->company_uid){
            $itemCount = 1;
            $itemPrice = $order->amount;
            $itemAmount = ($itemPrice * $itemCount);
            $saleAmount = $itemAmount;
            $taxAmount = round(($saleAmount * 0.05), 0);
            $data = [
                'MerchantID' => $merchantId,
                'RelateNumber' => 'INV-' . time(),
                'CustomerIdentifier' => $order->company_uid,
                'CustomerEmail' => $order->email,
                'InvType' => '07',
                'TaxType' => '1',
                'Items' => [
                    [
                        'ItemSeq' => 1,
                        'ItemName' => '測試商品01',
                        'ItemCount' => $itemCount,
                        'ItemPrice' => $itemPrice,
                        'ItemTaxType' => '1',
                        'ItemAmount' => $itemAmount,
                    ],
                ],
                'SalesAmount' => $saleAmount,
                'TaxAmount' => $taxAmount,
                'TotalAmount' => ($saleAmount + $taxAmount),
            ];
            $input = [
                'MerchantID' => '2000132',
                'RqHeader' => [
                    'Timestamp' => time(),
                    'Revision' => '1.0.0',
                ],
                'Data' => $data,
            ];
            $url = 'https://einvoice-stage.ecpay.com.tw/B2BInvoice/Issue';
        } else {
            $itemCount = 3;
            $itemPriceIncludeTax = 10.5;
            $itemAmount = round(($itemPriceIncludeTax * $itemCount), 0);
            $saleAmount = $itemAmount;
            $data = [
                'MerchantID' => $merchantId,
                'RelateNumber' => 'Test-' . time(),
                'CustomerPhone' => $order->mobile,
                'Print' => '0',
                'Donation' => '0',
                'CarrierType' => '1',
                'TaxType' => '1',
                'SalesAmount' => $saleAmount,
                'Items' => [
                    [
                        'ItemName' => '測試商品01',
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
                'MerchantID' => $merchantId,
                'RqHeader' => [
                    'Timestamp' => time(),
                ],
                'Data' => $data,
            ];
            $url = 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue';

        }

        // dd($data, $input, $url);

        $response = $postService->post($input, $url);

        return $response;

    }

}
