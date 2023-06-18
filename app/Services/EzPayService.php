<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductMix;

use Illuminate\Support\Facades\Http;

/**
 * Class EzPayService
 * @package App\Services
 */
class EzPayService
{

    // ezpay order
    public function invoice($request)
    {
        $merchantID = env('EZPAY_MERCHANT_ID');
        $hashKey = env('EZPAY_HASH_KEY');
        $hashIV = env('EZPAY_HASH_IV');

        // order
        $order = Order::where('order_no', $request->order_no)->first();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        $product_name_array = [];
        foreach ($order_details as $key => $value) {
            $product = Product::where('id', $value->product_id)->first();
            array_push($product_name_array, $product->name);
        }

        $product_name = implode('+', $product_name_array);

        $order_count = OrderDetail::where('order_id', $order->id)->count();

        // members
        $member = Member::where('id', $order->member_id)->first();

        // order type
        $type = $order->type;
        if ($type == 1) {
            $category = 'B2C';
        } else {
            $category = 'B2B';
        }

        $url = "https://inv.ezpay.com.tw/Api/invoice_issue";
        if (env('APP_ENV') == 'dev') {
            $url = "https://cinv.ezpay.com.tw/Api/invoice_issue";
        }


        $postDataArray = [
            'RespondType' => 'JSON',
            'Version' => '1.5',
            'TimeStamp' => time(),
            'MerchantOrderNo' => $order->order_no,
            'Status' => 1,
            'Category' => $category,
            'BuyerName' => $member->name,
            'BuyerEmail' => $member->email,
            'PrintFlag' => 'N',
            'TaxType' => 1,
            'TaxRate' => 5,
            'Amt' => $order->amount,
            'TaxAmt' => $order->tax,
            'TotalAmt' => $order->amount + $order->tax,
            'ItemName' => $product_name,
            'ItemCount' => $order_count,
            'ItemUnit' => '個',
            'ItemPrice' => $category == 'B2C' ? $order->amount + $order->tax : $order->amount,
            'ItemAmt' => $category == 'B2C' ? $order->amount + $order->tax : $order->amount,
            'Status' => 1,
            'PrintFlag' => 'Y',
        ];

        // B2B
        if ($type == 2) {
            $postDataArray['BuyerName'] = $order->company_name;
            $postDataArray['BuyerUBN'] = $order->company_uid;
            $postDataArray['BuyerAddress'] = $order->company_address;
        }

        // dd($postDataArray);

        // post data 加密
        $postDataEncrypt = trim(bin2hex(openssl_encrypt(
            $this->addpadding(http_build_query($postDataArray)),
            'AES-256-CBC',
            $hashKey,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $hashIV
        )));

        $transaction_data_array = array(
            'MerchantID_' => $merchantID,
            'PostData_' => $postDataEncrypt
        );

        $transaction_data_str = http_build_query($transaction_data_array);

        $reponse = $this->curl_work($url, $transaction_data_str);

        dd($reponse);

        return $reponse;;
    }

    // ezpay addpadding
    private function addpadding($string, $blocksize = 32)
    {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }

    // curl_work function
    private function curl_work($url = '', $parameter = '')
    {
        $curl_options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'ezPay',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POST => '1',
            CURLOPT_POSTFIELDS => $parameter
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_errno($ch);
        curl_close($ch);
        
        return json_decode($result, true);
    }
}
