<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MingJSHK\NewebPay\Facades\NewebPay;

use App\Models\Ship;
use App\Models\Product;
use App\Models\ProductMix;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Member;

use App\Services\CartService;

class OrderApiController extends Controller
{

    // 取得訂單資訊
    public function getOrderInfo(Request $request)
    {
        $cartService = new CartService();
        $cart = $cartService->getCart();

        $ship = Ship::find($request->ship_id);

        $order = new Order();
        $order->order_no = date('YmdHis') . rand(100000, 999999);
        $order->ship_id = $ship->id;
        $order->ship_name = $ship->name;
        $order->ship_price = $ship->price;
        $order->total_price = $cart['total_price'] + $ship->price;
        $order->status = 0;
        $order->save();

        foreach ($cart['products'] as $product) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            $orderDetail->qty = $product['qty'];
            $orderDetail->price = $product['price'];
            $orderDetail->save();
        }

        return response()->json([
            'success' => true,
            'message' => '取得訂單資訊成功',
            'data' => $order
        ]);
    }

    // 取得付款結果
    public function getPayResult(Request $request)
    {
        $order = Order::where('order_no', $request->order_no)->first();
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => '付款成功',
            'data' => $order
        ]);
    }
}
