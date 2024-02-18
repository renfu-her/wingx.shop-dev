<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductMix;

/**
 * Class CartService
 * @package App\Services
 */
class CartService extends BaseService
{

    // cart item
    public function cart($req)
    {

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
    public function order()
    {

        $member_id = session()->get('member_id');

        $order = Order::create([
            'member_id' => $member_id,
            'status' => 0,
        ]);

        $cart = session()->get('cart');

        $cart_array = [];
        $kk = 0;
        foreach ($cart as $key => $value) {
            $product = Product::find($value['prod_id']);
            if (!empty($product)) {
                $cart_array[$kk] = $value;
                $kk++;
            }
        }

        $total = 0;

        foreach ($cart_array as $id => $details) {

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
    public function getCart()
    {

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        $cart_array = [];
        $kk = 0;
        foreach ($cart as $key => $value) {
            $product = Product::find($value['prod_id']);
            if (!empty($product)) {
                $cart_array[$kk] = $value;
                $kk++;
            }
        }

        return response()->json([
            'cart_count' => count($cart_array)
        ]);
    }

    // 所有的 cart session 轉為 cart
    public function getCartAll()
    {

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [];
        }

        // get all products
        $tmpCart = [];
        foreach ($cart as $key => $value) {
            $product = Product::find($value['prod_id']);
            if (!empty($product)) {
                array_push($tmpCart, $value);
            }
        }

        // session put again
        session()->put('cart', $tmpCart);
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [];
        }

        $cart_array = [];
        $kk = 0;
        foreach ($cart as $key => $value) {
            $product = Product::find($value['prod_id']);
            if (!empty($product)) {
                $cart_array[$kk] = $value;
                $kk++;
            }
        }

        foreach ($cart_array as $key => $value) {
            if ($value['dataBase'] == 'products') {
                $product = Product::find($value['prod_id']);
                $cart[$key]['prod_name'] = $product->name;
                $cart[$key]['prod_price'] = $value['price'];
                $cart[$key]['sub_total'] = $value['price'] * $value['qty'];
            } else {
                $product_mix = ProductMix::find($value['prod_id']);
                $product = Product::find($product_mix->product_id);
                $prod_name = [];
                array_push($prod_name, $product->name);
                if (!empty($product_mix->product_mix2)) {
                    array_push($prod_name, $product_mix->product_mix1);
                }
                if (!empty($product_mix->product_mix2)) {
                    array_push($prod_name, $product_mix->product_mix2);
                }


                $cart[$key]['prod_name'] = implode('+', $prod_name);
                $cart[$key]['prod_price'] = $product_mix->price;
                $cart[$key]['sub_total'] = $product_mix->price * $value['qty'];
            }

            if ($product->define_image == 0) {
                $cart[$key]['prod_image'] = 'https://down-tw.img.susercontent.com/file/' . $product->image;
            } else {
                $cart[$key]['prod_image'] = asset('upload/images/' . $product->id . '/' . $product->image);
            }
        }

        // dd($cart);

        return $cart;
    }

    // generate order no
    public function generateOrderNo()
    {

        date_default_timezone_set('Asia/Taipei'); // CDT

        list($usec, $sec) = explode(" ", microtime());
        $msec = round($usec * 1000);
        $millisecond = str_pad($msec, 3, '0', STR_PAD_RIGHT);

        $ordre_no = date('YmdHis') . $millisecond;

        return $ordre_no;
    }
}
