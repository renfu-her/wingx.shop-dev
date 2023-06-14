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
use MingJSHK\NewebPay\Facades\NewebPay;

class OrderController extends Controller
{

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
        $member = Member::find($member_id);

        $email = $member->email;
        $total = $req['total'];

        $req['accept_terms'] = $req['accept_terms'] == 'true' ? 1 : 0;

        $cart = session()->get('cart');

        $order_no = (new CartService())->generateOrderNo();

        $order = Order::create([
            'order_no' => $order_no,
            'name' => $req['name'],
            'member_id' => $member_id,
            'ship_id' => $req['ship_id'],
            'total' => $total,
            'status' => 0,
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
        ]);

        $order_id = $order->id;
        $desc = '';

        foreach($cart as $order_detail){
            $order_detail['order_id'] = $order->id;
            if($order_detail['dataBase'] == 'products'){
                $product = Product::find($order_detail['prod_id']);
                $desc .= $product->name;
                $name = $product->name;
            } else {
                $product = ProductMix::find($order_detail['prod_id']);
                $desc .= $product->description;
                $name = $product->description;
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

        $desc = substr($desc, 0, 50);

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
            ]);

        // 藍新金流的寫入方式
        return NewebPay::payment(
            $order_no, // 訂單編號
            $total, // 交易金額
            $desc, // 交易描述
            $email // 付款人信箱
        )->setClientBackURL(env('app.url'))
         ->submit();

    }
}
