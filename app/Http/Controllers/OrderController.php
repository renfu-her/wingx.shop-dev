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

class OrderController extends Controller
{

    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    // 訂單數量
    public function cartCount(Request $request){

        $cartService = (new CartService())->getCart();

        return $cartService;

    }

    // order store and order detail
    public function store(Request $request)
    {
        $req = $request->all();

        $member_id = $request->session()->get('member_id');
        if(empty($member_id)){
            return redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $email = $member->email;
        $total = intval(str_replace(',', '', $req['total']));

        $ttl_total = $total + $req['ship_price'];
        $tax = round($ttl_total * 0.05);
        $amount = $ttl_total - $tax;

        $req['accept_terms'] = $req['accept_terms'] == 'true' ? 1 : 0;

        $cart = session()->get('cart');

        $order_no = (new CartService())->generateOrderNo();

        $order = Order::create([
            'order_no' => $order_no,
            'name' => $req['name'],
            'member_id' => $member_id,
            'ship_id' => $req['ship_id'],
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
        ]);

        $order_id = $order->id;
        $desc = [];

        foreach($cart as $order_detail){
            $order_detail['order_id'] = $order->id;
            if($order_detail['dataBase'] == 'products'){
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
            ]);
        }

        // 使用者寫入資料
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

        if(!$desc || empty($desc) == ''){
            $desc = '商品組合';
        }

        $formData = [
            'CustomField1' => $order_no,
            'ItemDescription' => $desc,
            'ItemName' => $desc,
            'TotalAmount' => $ttl_total,
            'PaymentMethod' => 'ALL', // ALL, Credit, ATM, WebATM
        ];



        return $this->checkout->setReturnUrl(env('APP_URL') . '/cart/thanks')->setPostData($formData)->send();

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
        foreach($orders as $key => $value){

            $payment = $value->payment;
            if($payment == 'Credit_CreditCard'){
                $payment_name = '信用卡';
            }
            if($payment == 'WebATM'){
                $payment_name = 'WebATM';
            }
            if($payment == 'ATM'){
                $payment_name = 'ATM 轉帳';
            }
            if($payment == 'CVS'){
                $payment_name = '超商代碼繳費';
            }

            $orders[$key]['payment_name'] = $payment_name ?? '';
            $orders[$key]['ttl_price'] = $value->total + $value->ship_price;

            $order_details = OrderDetail::where('order_id', $value->id)->get();
            foreach($order_details as $k => $v){
                $product = Product::find($v->product_id);

                $order_details[$k]['image_url'] = '';
                if($product){
                    if($product->define_image == 0){
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
                'orders'
            )
        );
    }
}
