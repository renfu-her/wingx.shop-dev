<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductMix;
use App\Models\Ship;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Member;

class OrderAdminController extends Controller
{
    // 訂單列表
    public function index(Request $request)
    {
        $req = $request->all();

        $orders = Order::orderBy('id', 'desc')->paginate(10);

        foreach($orders as $key => $value){

            // 付款方式
            $payment = $value->payment;
            $payment_name = '';
            if($payment == 'CREDIT'){
                $payment_name = '信用卡';
            }
            if($payment == 'WEBATM'){
                $payment_name = 'WebATM';
            }
            if($payment == 'VACC'){
                $payment_name = 'ATM 轉帳';
            }
            if($payment == 'CVS'){
                $payment_name = '超商代碼繳費';
            }

            // 0:待付款 1:完成付款 2:付款失敗 3:取消訂單 9:訂單異常
            $status_name = '';
            if($value->status == 0 || $value->status == 9){
                $status_name = '<span style="color: green">待付款</span>';
            }
            if($value->status == 1){
                $status_name = '<span style="color: blue">完成付款</span>';
            }
            if($value->status == 2){
                $status_name = '<span style="color: red">付款失敗</span>';
            }
            if($value->status == 3){
                $status_name = '<span style="color: gray">取消訂單</span>';
            }

            $member = Member::find($value->member_id);
            $orders[$key]['member_name'] = $member->name;
            $orders[$key]['member_email'] = $member->email;
            $orders[$key]['status_name'] = $status_name;
            $orders[$key]['payment_name'] = $payment_name;
            $orders[$key]['ttl_price'] = $value->total + $value->ship_price;
        }

        return view('backend.order.index', compact('orders'));
    }

    // 訂單詳細資料
    public function show(Request $request, $id)
    {
        $req = $request->all();

        $order = Order::find($id);

        $orderDetails = OrderDetail::where('order_id', $id)->get();

        foreach($orderDetails as $key => $value){
            $product = Product::find($value['product_id']);
            $orderDetails[$key]['product_name'] = $product->name ?? '';
        }

        return view('backend.order.show', compact('order', 'orderDetails'));
    }
}
