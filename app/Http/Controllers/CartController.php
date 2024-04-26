<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

use App\Models\Member;
use App\Models\Order;
use App\Models\ProductDetail;

use App\Services\EcPayService;

use MingJSHK\NewebPay\Facades\NewebPay;
use Pharaoh\Express\Facades\Express;

class CartController extends Controller
{
    // cart
    public function index(Request $request)
    {

        $member_id = session()->get('member_id');
        if (!$member_id) {
            redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $req = $request->all();
        $req['member_id'] = $member_id;

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['price'] * $value['qty'];
            $tax +=  ($value['price'] * $value['qty']) * 0.05;
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
        if (empty($member_id)) {
            return redirect('/')->with(['message' => '請先登入會員']);
        }

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
        $shipLogistics = $total + 60;

        // if($shipLogistics > 20000){
        //     unset($ship[1]);
        //     unset($ship[2]);
        // }

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
                'cart_count',
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

        // $neweb_pay = NewebPay::decode($req['TradeInfo']);

        if ($req['RtnCode'] == 1) {

            // 更新訂單
            $merchantOrderNo = $req['CustomField1'];
            $order = Order::where('order_no', $merchantOrderNo)->first();
            $order->payment = $req['PaymentType'];
            $order->status = 1;
            $order->save();

            // 更新發票
            // $ecpayService = new EcPayService();
            // $eInvoice = $ecpayService->ecpayInvoice($merchantOrderNo);

            // if ($eInvoice['TransCode'] == 1) {
            //     $e_invoice = $eInvoice['Data'];
            //     $order = Order::where('order_no', $merchantOrderNo)->first();
            //     $order->invoice_no = $e_invoice['InvoiceNumber'] ?? $e_invoice['InvoiceNo'];
            //     $order->invoice_random_no = $e_invoice['RandomNumber'];
            //     $order->save();
            // };

            $status = 'success';
            return view('frontend.thanks', compact('order', 'status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
        } else {

            $status = 'fail';

            return view('frontend.thanks', compact('status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
        }
    }

    // 刪除 cart session
    public function cartDelete(Request $request)
    {

        $data = $request->all();
        $deleteId = $data['deleteId'];

        $cart = session('cart', []);

        // dd($deleteId, $cart);

        // 使用 array_values 和 array_filter 来重置键并移除具有特定 id 的项目
        if (array_key_exists($deleteId, $cart)) {
            unset($cart[$deleteId]);
        }

        // 将更新后的购物车数组存回会话
        session(['cart' => $cart]);
    }

    // server, client reply
    public function serverReply(Request $request)
    {

        $data = $request->all();

        // return view('frontend.order.ecpayStore', compact('data'));
    }

    public function clientReply(Request $request)
    {
        $data = $request->all();

        // dd($data);
        $order = Order::where('order_no', $data['MerchantTradeNo'])->first();
        $order->pay_logistics_id = $data['AllPayLogisticsID'];
        $order->save();

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

        if ($data['LogisticsSubType'] == 'FAMIC2C') {
            $logisticsSubType = "全家店到店";
        } else {
            $logisticsSubType = "7-11 交貨便";
        }

        return view(
            'frontend.order.clientReply',
            compact(
                'data',
                'logisticsSubType',
                'products',
                'product_categories',
                'cart_count',
                'cart',
                'total',
                'tax',
                'ships',
            )
        );
    }
}
