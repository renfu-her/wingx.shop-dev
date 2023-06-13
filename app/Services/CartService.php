<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;


/**
 * Class CartService
 * @package App\Services
 */
class CartService extends BaseService
{

    // cart item
    public function cart($req){

        $item = [
            'id' => $req['id'],
            'dataBase' => $req['dataBase'],
            'prod_id' => $req['prod_id'],
            'price' => $req['price'],
            'qty' => $req['qty'],
        ];

        session()->push('cart', $item);

    }

    // order detail
    public function order(){

        $member_id = session()->get('member_id');

        $order = Order::create([
            'member_id' => $member_id,
            'status' => 0,
        ]);

        $cart = session()->get('cart');

        $total = 0;

        foreach($cart as $id => $details){

            $product = Product::find($details->prod_id);

            $total += $product->price * $details['qty'];

            OrderDetail::create([
                'order_no' => $order->id,
                'prod_id' => $id,
                'qty' => $details['qty'],
                'price' => $product->price
            ]);
        }

        $order->total = $total;
        $order->save();

        return $order;
    }

    // session cart get
    public function getCart(){

        $cart = session()->get('cart');
        if(!$cart){
            $cart = [];
        }
        return response()->json([
            'cart_count' => count($cart)
        ]);
    }

    // 所有的 cart session 轉為 cart
    public function getCartAll(){

        $cart = session()->get('cart');
        if(!$cart){
            $cart = [];
        }

        foreach($cart as $key => $value){
            $product = Product::find($value['prod_id']);
            $cart[$key]['prod_name'] = $product->name;
            $cart[$key]['prod_price'] = $product->price * $value['qty'];
            $cart[$key]['sub_total'] = ($product->price * $value['qty']) * $value['qty'];
            if($value['dataBase'] == 'products'){
                $cart[$key]['prod_image'] = 'https://down-tw.img.susercontent.com/file/' . $product->image;
            } else {
                $cart[$key]['prod_image'] = asset('upload/images/' . $product->image);
            }
        }

        return $cart;
    }
}
