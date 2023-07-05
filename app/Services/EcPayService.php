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
            $hashIv = config('config.INVOCE_HASH_IV_DEV');
        } else {
            $url = "https://einvoice.ecpay.com.tw/B2CInvoice/Issue";
            $merchantId = config('config.INVOICE_ID');
            $hashKey = config('config.INVOICE_HASH_KEY');
            $hashIv = config('config.INVOCE_HASH_IV');
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

        // 依照英文字母順序排序，再串接為字串
        ksort($data);
        $data_json = json_encode($data, JSON_UNESCAPED_UNICODE);
        $data_json = str_replace('{','',$data_json);
        $data_json = str_replace('}','',$data_json);
        $data_json = str_replace('"','',$data_json);
        $data_json = str_replace(':','=',$data_json);
        $data_json = str_replace(',','&',$data_json);

        //  塞入HashKey以及HashIV
        $originStr = 'HashKey=ejCk326UnaZWKisg&' .$data_json. '&HashIV=q9jcZX8Ib9LM8wYk';

        //  以urlencode做URI(Uniform Resource Identifier)的轉換
        $originStr = urlencode($originStr);

        //  轉為小寫
        $originStr = strtolower($originStr);

        //  利用str_replace以其他字符替换字符串中的一些字符
        $originStr = str_replace('%20', '+', $originStr);
        $originStr = str_replace('%21', '!', $originStr);
        $originStr = str_replace('%2a', '*', $originStr);
        $originStr = str_replace('%2d', '-', $originStr);
        $originStr = str_replace('%2e', '.', $originStr);
        $originStr = str_replace('%28', '(', $originStr);
        $originStr = str_replace('%29', ')', $originStr);
        $originStr = str_replace('%5f', '_', $originStr);

        //  MD5加密方式
        $hashed = hash("md5",$originStr);

        //  轉為大寫
        $checkMacValue = strtoupper($hashed);

        $invoice = Http::post($url, [
            'MerchantID_' => $merchantId,
            'ReqHeader' => [
                'Timestamp' => time(),
                'Revision' => '3.0.0',
            ],
            'Data' => $checkMacValue,
        ]);

        return $invoice;

    }

}
