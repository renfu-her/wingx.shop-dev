<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

use App\Models\Ship;
use App\Models\Product;
use App\Models\ProductMix;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Member;
use App\Models\CvsStoreDetail;
use App\Models\LogisticsStatus;
// use MingJSHK\NewebPay\Facades\NewebPay;
use TsaiYiHua\ECPay\Checkout;
use Pharaoh\Express\Facades\Express;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    // 訂單數量
    public function cartCount(Request $request)
    {
        $cartService = (new CartService())->getCart();

        return $cartService;
    }

    // order store and order detail
    public function store(Request $request)
    {
        $req = $request->all();

        $member_id = Auth::guard('member')->user()->id;
        if (empty($member_id)) {
            return redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $email = $member->email;
        $total = intval(str_replace(',', '', $req['total']));

        $ttl_total = $total + $req['ship_price'];
        $amount = round($ttl_total / 1.05);
        $tax = $ttl_total - $amount;

        $req['accept_terms'] = $req['accept_terms'] == 'true' ? 1 : 0;

        $cart = session()->get('cart');

        if (count($cart) == 0) {
            return redirect('/')->with(['message' => '訂單要 1 件以上！']);
        }

        $order_no = (new CartService())->generateOrderNo();

        $order = Order::create([
            'order_no' => $order_no,
            'name' => $req['name'],
            'member_id' => $member_id,
            'ship_id' => $req['ship_id'] ?? 0,
            'total' => $total,
            'status' => 9,
            'email' => $req['email'],
            'ship_date' => date('Y-m-d H:i:s'),
            'ship_price' => $req['ship_price'],
            'remark' => $req['remark'],
            'county' => $req['county'],
            'district' => $req['district'],
            'zipcode' => $req['zipcode'],
            'address' => $req['address'],
            'mobile' => $req['mobile'],
            'accept_terms' => $req['accept_terms'],
            'type' => $req['type'],
            'company_name' => $req['company_name'] ?? '',
            'company_uid' => $req['company_uid'] ?? '',
            'company_address' => $req['company_address'] ?? '',
            'amount' => $amount,
            'tax' => $tax,
            'carrier_type' => $req['carrier_type'] ?? '',
            'carrier_num' => $req['carrier_num'] ?? '',
        ]);



        $order_id = $order->id;
        $desc = [];

        foreach ($cart as $order_detail) {
            // $order_detail['order_id'] = $order->id;
            if ($order_detail['dataBase'] == 'products') {
                $product = Product::find($order_detail['prod_id']);
                array_push($desc, $product->name);
                $name = $product->name;
            } else {
                $product = ProductMix::find($order_detail['prod_id']);
                array_push($desc, $product->description ?? '商品組合');
                $name = $product->description ?? '商品組合';
            }

            OrderDetail::create([
                'order_id' => $order_id,
                'name' => $name,
                'product_id' => $order_detail['prod_id'],
                'qty' => $order_detail['qty'],
                'price' => $order_detail['price'],
                'data_base' => $order_detail['dataBase'],
                'sub_total' => $order_detail['price'] * $order_detail['qty'],
                'items' => $order_detail['items'],
            ]);
        }

        // // 使用者寫入資料
        Member::where('id', $member_id)->update(
            [
                'username' => $req['name'],
                'email' => $req['email'],
                'county' => $req['county'],
                'district' => $req['district'],
                'zipcode' => $req['zipcode'],
                'address' => $req['address'],
                'mobile' => $req['mobile'],
            ]
        );

        $desc = implode('+', $desc);
        $desc = substr($desc, 0, 50);

        if (!$desc || empty($desc) == '') {
            $desc = '商品組合';
        }

        // 店到店
        // CVSStoreID 有值 
        if (!empty($req['CVSStoreID'])) {

            $order->cvs_store_id = $req['CVSStoreID'];
            $order->save();

            //TODO: 寫入或者更新 cvs_store_details
            CvsStoreDetail::updateOrCreate(
                ['store_id' => $req['CVSStoreID']],
                [
                    'store_name' => $req['CVSStoreName'],
                    'address' => $req['CVSAddress'],
                    'telephone' => $req['CVSTelephone'],
                ]
            );

            $logisticsConfig = config('ecpay.logistics');
            $callbackBaseUrl = config('ecpay.callback_base_url');
            $mapUrl = $logisticsConfig['create_url'];
            $merchantID = $logisticsConfig['merchant_id'];

            $logisticsData = [
                'MerchantID' => $merchantID,
                'MerchantTradeNo' => $order_no,
                'MerchantTradeDate' => date('Y/m/d H:i:s'),
                'LogisticsType' => 'CVS',
                'LogisticsSubType' => $req['LogisticsSubType'],
                'GoodsAmount' => $ttl_total,
                'CollectionAmount' => $ttl_total,
                // 'IsCollection' => 'N',
                'GoodsName' => $desc,
                'SenderName' => $member->username,
                'SenderPhone' => $member->mobile,
                'SenderCellPhone' => $member->mobile,
                'ReceiverName' => $req['name'],
                // 'ReceiverPhone' => $req['mobile'],
                'ReceiverCellPhone' => $req['mobile'],
                // 'ReceiverEmail' => $req['email'],
                'ReceiverStoreID' => $req['CVSStoreID'],
                'ReturnStoreID' => $req['CVSStoreID'],
                'ServerReplyURL' => $callbackBaseUrl . '/cart/server/reply',
                'ClientReplyURL' => $callbackBaseUrl . '/cart/client/reply',
            ];

            $checkMacValue = $this->checkMacValue($logisticsData, $logisticsConfig['hash_key'], $logisticsConfig['hash_iv']);

            $logisticsData['CheckMacValue'] = $checkMacValue;

            $orderData = Http::asForm()->post($mapUrl, $logisticsData);

            // 獲取訂單詳細信息
            $orderDetails = OrderDetail::where('order_id', $order->id)->get(); // 根據您的邏輯獲取訂單詳細信息

            // 發送郵件
            $this->sendOrderConfirmationEmail($order, $orderDetails); // 添加這行來發送郵件

            session()->forget('cart');

            return view('frontend.order.store', compact('orderData'));
        } else {

            $callbackBaseUrl = config('ecpay.callback_base_url');
            $notifyUrl = $callbackBaseUrl . '/cart/payment/notify';
            $returnUrl = $callbackBaseUrl . '/cart/thanks';

            $formData = [
                'OrderId' => $order_no,
                'CustomField1' => $order_no,
                'ItemDescription' => $desc,
                'ItemName' => $desc,
                'TotalAmount' => $ttl_total,
                'PaymentMethod' => 'ALL', // ALL, Credit, ATM, WebATM
                'NeedExtraPaidInfo' => 'Y',
                'OrderResultURL' => $returnUrl,
            ];

            return $this->checkout
                ->setNotifyUrl($notifyUrl)
                ->setReturnUrl($returnUrl)
                ->setPostData($formData)
                ->send();
        }
    }

    public function checkCarrierNum(Request $request)
    {
        $invoiceConfig = config('ecpay.invoice');
        $url = $invoiceConfig['check_barcode_url'];
        $merchantId = $invoiceConfig['merchant_id'];
        $hashKey = $invoiceConfig['hash_key'];
        $hashIV = $invoiceConfig['hash_iv'];

        $data = [
            'MerchantID' => $merchantId,
            'BarCode' => $request['barCode'],
        ];

        $encryptedData = $this->encryptECPay(json_encode($data), $hashKey, $hashIV);


        $requestData = [
            'MerchantID' => $merchantId,
            'RqHeader' => [
                'Timestamp' => time(),
                'Revision' => '1.0.0',
            ],
            'Data' => $encryptedData,
        ];

        $response = Http::post($url, $requestData)->json();


        if (isset($response['Data'])) {
            $decryptedData = $this->decryptECPay($response['Data'], $hashKey, $hashIV);
            $resultData = json_decode($decryptedData, true);

            return response()->json($resultData);
        }
    }

    private function encryptECPay($data, $hashKey, $hashIV)
    {
        $data = urlencode($data);
        $cipher = "aes-128-cbc";
        $options = OPENSSL_RAW_DATA;
        $encrypted = openssl_encrypt($data, $cipher, $hashKey, $options, $hashIV);
        return base64_encode($encrypted);
    }

    private function decryptECPay($encryptedData, $hashKey, $hashIV)
    {
        $cipher = "aes-128-cbc";
        $options = OPENSSL_RAW_DATA;
        $decoded = base64_decode($encryptedData);
        $decrypted = openssl_decrypt($decoded, $cipher, $hashKey, $options, $hashIV);
        return urldecode($decrypted);
    }

    private function sendOrderConfirmationEmail($order, $orderDetails)
    {
        $to = $order->email; // 確保訂單中有 email 欄位
        $subject = '感謝您訂購商品';

        // 使用 HTML 格式構建郵件內容
        $message = "<h2>感謝您訂購商品</h2>";
        $message .= "<p style='color: red; font-weight: bold; font-size: 22px;'>商品/貨品到商店後，會發送簡訊通知要前往付款</p>";
        $message .= "<table style='width: 100%; border-collapse: collapse;'>";
        $message .= "<p>若您於垃圾信件中收到此通知，請點選上方「這不是垃圾信」的按鍵或將選擇「加入通訊錄」。</p>";
        $message .= "<tr><th style='border: 1px solid #ddd; padding: 8px;'>商品名稱</th><th style='border: 1px solid #ddd; padding: 8px;'>數量</th><th style='border: 1px solid #ddd; padding: 8px;'>價格</th><th style='border: 1px solid #ddd; padding: 8px;'>材質</th></tr>";

        foreach ($orderDetails as $detail) {
            $message .= "<tr>";
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->name}</td>"; // 假設有 product_name 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->qty}</td>"; // 假設有 quantity 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->price}</td>"; // 假設有 price 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->items}</td>"; // 假設有 price 屬性
            $message .= "</tr>";
        }

        $message .= "</table>";

        $message .= "<p style='text-align: center;'><a href='https://wingx.shop/order/list' style='display: inline-block; background-color: #6a5acd; color: white; padding: 10px 20px; text-align: center; text-decoration: none; border-radius: 5px;'>訂單查詢</a></p>"; // 新增的按鈕

        // 使用 Mail::html 發送 HTML 郵件
        Mail::html($message, function ($mail) use ($to, $subject) {
            $mail->to($to)
                ->subject($subject);
        });
    }

    // order list
    public function list(Request $request)
    {
        $member_id = Auth::guard('member')->user()->id ?? '';

        // 沒有登入的狀況
        if (empty($member_id)) {
            return redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $orders = Order::where('member_id', $member_id)->orderBy('id', 'desc')->get();

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $ships = $this->getShipAll();

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        $orders = Order::where('member_id', $member_id)->orderBy('id', 'desc')->get();
        foreach ($orders as $key => $value) {

            $payment = $value->payment;
            if (str_contains($payment, 'Credit')) {
                $payment_name = '信用卡';
            }
            if (str_contains($payment, 'ATM')) {
                $payment_name = 'ATM 轉帳';
            }
            if (str_contains($payment, 'WebATM')) {
                $payment_name = 'WebATM';
            }
            if (str_contains($payment, 'CVS')) {
                $payment_name = '超商代碼繳費';
            }

            $orders[$key]['payment_name'] = $payment_name ?? '尚未選擇付款方式';
            $orders[$key]['ttl_price'] = $value->total + $value->ship_price;

            $order_details = OrderDetail::where('order_id', $value->id)->get();
            foreach ($order_details as $k => $v) {
                $product = Product::find($v->product_id);

                $order_details[$k]['image_url'] = '';
                if ($product) {
                    if ($product->define_image == 0) {
                        $order_details[$k]['image_url'] = 'https://down-tw.img.susercontent.com/file/' . $product->image;
                    } else {
                        $order_details[$k]['image_url'] = asset('upload/images/' . $product->id . '/' . $product->image);
                    }
                }

                $order_details[$k]['ttl_price'] = intval(str_replace(',', '', $v->total)) + $v->ship_price;
            }
            $orders[$key]['order_detail'] = $order_details;
        }


        return view(
            'frontend.order.orderList',
            compact(
                'products',
                'product_categories',
                'orders',
                'member',
                'cart_count',
                'total',
                'tax',
                'ships',
                'cart_count',
                'orders',
                'cart'
            )
        );
    }

    //TODO: 貨品的狀態 order status
    public function orderStatus(Request $request, $logisticsId)
    {
        $data = $request->all();

        $order = Order::where('pay_logistics_id', $logisticsId)->first();
        $logisticsConfig = config('ecpay.logistics');
        $logisticsUrl = $logisticsConfig['query_url'];
        $merchantId = $logisticsConfig['merchant_id'];
        $hashKey = $logisticsConfig['hash_key'];
        $hashIV = $logisticsConfig['hash_iv'];

        $logisticsData = [
            'MerchantID' => $merchantId,
            "AllPayLogisticsID" => $logisticsId,
            "TimeStamp" => Carbon::now()->timestamp,
        ];

        $checkMacValue = $this->checkMacValue($logisticsData, $hashKey, $hashIV);

        $logisticsData['CheckMacValue'] = $checkMacValue;

        $logistics = Http::asForm()->post($logisticsUrl, $logisticsData);

        $logisticsArray = [];
        parse_str($logistics->body(), $logisticsArray);

        if (empty($logisticsArray['LogisticsStatus'])) {
            return redirect()->route('order.list')->with([
                'message' => '目前無法取得物流狀態，請稍後再試。',
            ]);
        }

        if (($logisticsArray['LogisticsType'] ?? '') == 'CVS_FAMIC2C') {
            $logisticsArray['LogisticsName'] = '全家店到店';
        } else {
            $logisticsArray['LogisticsName'] = '7-11 交貨便';
        }

        $logisticsStatus = LogisticsStatus::where('code', $logisticsArray['LogisticsStatus'])->first();
        $logisticsArray['LogisticsStatusName'] = $logisticsStatus->message ?? null;

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $ships = $this->getShipAll();

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        // csv_store_id 來取得店家資訊
        $cvs_store_id = $order->cvs_store_id;
        $storeDetails = CvsStoreDetail::where('store_id', $cvs_store_id)->first();

        return view(
            'frontend.order.orderStatus',
            compact(
                'logisticsArray',
                'order',
                'products',
                'product_categories',
                'total',
                'tax',
                'cart_count',
                'storeDetails',
            )
        );
    }

    // 取消貨品寄送
    public function cancelOrder(Request $request, $logisticsId)
    {
        $data = $request->all();

        $order = Order::where('pay_logistics_id', $logisticsId)->first();
        $order->status = 3;
        $order->save();

        return redirect()->route('order.list');
    }

    // 檢查碼
    public function checkMacValue(array $params, $hashKey, $hashIV, $encType = 1)
    {
        // 0) 如果資料中有 null，必需轉成空字串
        $params = array_map('strval', $params);

        // 1) 如果資料中有 CheckMacValue 必需先移除
        unset($params['CheckMacValue']);

        // 2) 將鍵值由 A-Z 排序
        uksort($params, 'strcasecmp');

        // 3) 將陣列轉為 query 字串
        $paramsString = urldecode(http_build_query($params));

        // 4) 最前方加入 HashKey，最後方加入 HashIV
        $paramsString = "HashKey={$hashKey}&{$paramsString}&HashIV={$hashIV}";

        // 5) 做 URLEncode
        $paramsString = urlencode($paramsString);

        // dd($paramsString);

        // 6) 轉為全小寫
        $paramsString = strtolower($paramsString);

        // 7) 轉換特定字元(與 dotNet 相符的字元)
        $search  = ['%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29'];
        $replace = ['-',   '_',   '.',   '!',   '*',   '(',   ')'];
        $paramsString = str_replace($search, $replace, $paramsString);

        // 8) 進行編碼
        // dd(md5($paramsString));
        // $paramsString = $encType ? hash('sha256', $paramsString) : md5($paramsString);
        $paramsString = md5($paramsString);

        // 9) 轉為全大寫後回傳
        return strtoupper($paramsString);
    }
}
