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
        if (config('config.APP_ENV') == 'dev') {
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

        if (!empty($order->company_uid)) {
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
            $itemCount = 1;
            $itemPriceIncludeTax = $order->amount + $order->tax;
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
        }


        $response = $postService->post($input, $url);

        return $response;
    }
}
