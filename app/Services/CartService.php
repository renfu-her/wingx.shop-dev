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

    public function order(){

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => 'pending',
            'total' => 0
        ]);

        $cart = session()->get('cart');

        $total = 0;

        foreach($cart as $id => $details){

            $product = Product::find($id);

            $total += $product->price * $details['quantity'];

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $product->price
            ]);
        }

        $order->total = $total;
        $order->save();

        return $order;

    }
}
