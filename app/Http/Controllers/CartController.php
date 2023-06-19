<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

use App\Models\Member;
use App\Models\Order;

use App\Services\EzPayService;

use MingJSHK\NewebPay\Facades\NewebPay;

class CartController extends Controller
{
    // cart
    public function index(Request $request)
    {

        $member_id = session()->get('member_id');
        $member = Member::find($member_id);

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $req = $request->all();
        $req['member_id'] = $member_id;

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


        return view(
            'frontend.cart',
            compact(
                'products',
                'product_categories',
                'cart',
                'total',
                'tax',
                'ships',
                'member',
                'cart_count'
            )
        );
    }

    // cart order
    public function order(Request $request)
    {

        $member_id = session()->get('member_id');

        $req = $request->all();
        $req['member_id'] = $member_id;

        $cartService = (new CartService())->cart($req);

        return response()->json([
            'status' => 'success',
            'message' => '已經加入購物車',
        ]);
    }

    // cart checkout
    public function checkout(Request $request)
    {

        $member_id = session()->get('member_id');
        $member = Member::find($member_id);

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $req = $request->all();
        $req['member_id'] = $member_id;

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

        return view(
            'frontend.checkout',
            compact(
                'products',
                'product_categories',
                'cart',
                'total',
                'tax',
                'ships',
                'member',
                'cart_count'
            )
        );
    }

    // order payment thanks
    public function thanks(Request $request)
    {

        $req = $request->all();

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

        $neweb_pay = NewebPay::decode($req['TradeInfo']);

        if ($neweb_pay['Status'] == 'SUCCESS') {
            $merchantOrderNo = $neweb_pay['Result']['MerchantOrderNo'];
            $order = Order::where('order_no', $merchantOrderNo)->first();
            $order->payment = $neweb_pay['Result']['PaymentType'];
            $order->status = 1;
            $order->save();

            $status = 'success';

            // 發票開立 ezpay
            $ezpay = (new EzPayService())->invoice($order);
            
            if ($ezpay['Status'] == 'SUCCESS' ) {
                $ezpayResult = json_decode($ezpay['Result'], true);
                $order = Order::where('order_no', $merchantOrderNo)->first();
                $order->invoice_no = $ezpayResult['InvoiceNumber'];
                $order->invoice_trans_no = $ezpayResult['InvoiceTransNo'];
                $order->invoice_date = $ezpayResult['CreateTime'];
                $order->invoice_random_no = $ezpayResult['RandomNum'];
                $order->invoice_checkcode = $ezpayResult['CheckCode'];
                $order->invoice_total_amt = $ezpayResult['TotalAmt'];
                $order->save();
            }

            return view('frontend.thanks', compact('order', 'status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
        } else {

            $status = 'fail';

            return view('frontend.thanks', compact('status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));

        }
    }
}
