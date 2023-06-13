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

    public function cart($req){

        $cart = [
            'dataBase' => $req['dataBase'],
            'prod_id' => $req['prod_id'],
            'price' => $req['price'],
            'qty' => $req['qty'],
        ];

        session()->put('cart', $cart);

    }

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
}
