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
// use MingJSHK\NewebPay\Facades\NewebPay;
use TsaiYiHua\ECPay\Checkout;
use Pharaoh\Express\Facades\Express;
use Illuminate\Support\Facades\Http;


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

        $member_id = session()->get('member_id');
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

        // $order = Order::create([
        //     'order_no' => $order_no,
        //     'name' => $req['name'],
        //     'member_id' => $member_id,
        //     'ship_id' => $req['ship_id'] ?? 0,
        //     'total' => $total,
        //     'status' => 9,
        //     'email' => $req['email'],
        //     'ship_date' => date('Y-m-d H:i:s'),
        //     'ship_price' => $req['ship_price'],
        //     'remark' => $req['remark'],
        //     'county' => $req['county'],
        //     'district' => $req['district'],
        //     'zipcode' => $req['zipcode'],
        //     'address' => $req['address'],
        //     'mobile' => $req['mobile'],
        //     'accept_terms' => $req['accept_terms'],
        //     'type' => $req['type'],
        //     'company_name' => $req['company_name'] ?? '',
        //     'company_uid' => $req['company_uid'] ?? '',
        //     'company_address' => $req['company_address'] ?? '',
        //     'amount' => $amount,
        //     'tax' => $tax,
        // ]);

        // $order_id = $order->id;
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

            //     OrderDetail::create([
            //         'order_id' => $order_id,
            //         'name' => $name,
            //         'product_id' => $order_detail['prod_id'],
            //         'qty' => $order_detail['qty'],
            //         'price' => $order_detail['price'],
            //         'data_base' => $order_detail['dataBase'],
            //         'sub_total' => $order_detail['price'] * $order_detail['qty'],
            //         'items' => $order_detail['items'],
            //     ]);
        }

        // // 使用者寫入資料
        // Member::where('id', $member_id)->update(
        //     [
        //         'username' => $req['name'],
        //         'email' => $req['email'],
        //         'county' => $req['county'],
        //         'district' => $req['district'],
        //         'zipcode' => $req['zipcode'],
        //         'address' => $req['address'],
        //         'mobile' => $req['mobile'],
        //     ]
        // );

        $desc = implode('+', $desc);
        $desc = substr($desc, 0, 50);

        if (!$desc || empty($desc) == '') {
            $desc = '商品組合';
        }

        // $formData = [
        //     'CustomField1' => $order_no,
        //     'ItemDescription' => $desc,
        //     'ItemName' => $desc,
        //     'TotalAmount' => $ttl_total,
        //     'PaymentMethod' => 'ALL', // ALL, Credit, ATM, WebATM
        // ];

        // if (config('config.APP_ENV') == 'local') {
        //     $url = config('config.APP_URL') . "/cart/thanks";
        // } else {
        //     $url = "https://wingx.shop/cart/thanks";
        // }

        // 店到店
        // CVSStoreID 有值 
        if (!empty($req['CVSStoreID'])) {
            if (config('config.APP_ENV') == 'local') {
                $mapUrl = 'https://logistics-stage.ecpay.com.tw/Express/Create';
                $merchantID = config('config.EXPRESS_MERCHANT_ID_DEV');
            } else {
                $mapUrl = 'https://logistics.ecpay.com.tw/Express/Create';
                $merchantID = config('config.EXPRESS_MERCHANT_ID');
            }

            $logisticsData = [
                'MerchantID' => $merchantID,
                'MerchantTradeDate' => date('Y/m/d H:i:s'),
                'LogisticsType' => 'CVS',
                'LogisticsSubType' => $req['LogisticsSubType'],
                'GoodsAmount' => $ttl_total,
                'CollectionAmount' => $ttl_total,
                // 'IsCollection' => 'N',
                // 'GoodsName' => $desc,
                'SenderName' => '陳慧珊',
                'SenderPhone' => '06-7944217',
                // 'SenderCellPhone' => $req['mobile'],
                'ReceiverName' => $req['name'],
                // 'ReceiverPhone' => $req['mobile'],
                'ReceiverCellPhone' => $req['mobile'],
                // 'ReceiverEmail' => $req['email'],
                'ReceiverStoreID' => $req['CVSStoreID'],
                'ReturnStoreID' => $req['CVSStoreID'],
                'ServerReplyURL' => config('config.APP_URL') . '/cart/server/reply',
                'ClientReplyURL' => config('config.APP_URL') . '/cart/client/reply',
            ];

            if (config('config.APP_ENV') == 'local') {
                $checkMacValue = $this->checkMacValue($logisticsData, config('config.EXPRESS_HASH_KEY_DEV'), config('config.EXPRESS_HASH_IV_DEV'));
            } else {
                $checkMacValue = $this->checkMacValue($logisticsData, config('config.EXPRESS_HASH_KEY'), config('config.EXPRESS_HASH_IV'));
            }

            $logisticsData['CheckMacValue'] = $checkMacValue;

            $logistics = Http::asForm()->post($mapUrl, $logisticsData);

            dd(
                $logistics->body(),
                $mapUrl,
                $logisticsData,
                $merchantID,
                config('config.APP_ENV'),
                config('config.EXPRESS_HASH_KEY_DEV'),
                config('config.EXPRESS_HASH_IV_DEV'),
                
            );
        }

        // return $this->checkout->setReturnUrl($url)->setPostData($formData)->send();
    }

    // order list
    public function list(Request $request)
    {


        $member_id = session()->get('member_id');
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
            'frontend.order_list',
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

    // 檢查碼
    private function checkMacValue(array $params, $hashKey, $hashIV, $encType = 1)
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
        $paramsString = $encType ? hash('sha256', $paramsString) : md5($paramsString);

        // 9) 轉為全大寫後回傳
        return strtoupper($paramsString);
    }
}
