<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\CvsStoreDetail;

use App\Services\EcPayService;

use MingJSHK\NewebPay\Facades\NewebPay;
use Pharaoh\Express\Facades\Express;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function __construct() {}

    // cart
    public function index(Request $request)
    {

        $member_id = Auth::guard('member')->user()->id;
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

        $member_id = Auth::guard('member')->user()->id;

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

        // $this->middleware('auth:member');
        // dd(auth()->guard('member')->user());
        $member_id = Auth::guard('member')->user()->id ?? '';
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
        if ($shipLogistics > 20000) {
            foreach ($ships as $key => $ship) {
                if ($ship['id'] == 1 || $ship['id'] == 2) {
                    unset($ships[$key]);
                }
            }
        }

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
            $ecpayService = new EcPayService();
            $eInvoice = $ecpayService->ecpayInvoice($merchantOrderNo);

            if ($eInvoice['TransCode'] == 1) {
                $e_invoice = $eInvoice['Data'];
                $order = Order::where('order_no', $merchantOrderNo)->first();
                $order->invoice_no = $e_invoice['InvoiceNumber'] ?? $e_invoice['InvoiceNo'];
                $order->invoice_random_no = $e_invoice['RandomNumber'];
                $order->save();
            };

            // 獲取訂單詳細信息
            $orderDetails = OrderDetail::where('order_id', $order->id)->get(); // 根據您的邏輯獲取訂單詳細信息

            // 發送郵件
            $this->sendOrderConfirmationEmail($order, $orderDetails); // 傳遞 OrderDetail

            $status = 'success';
            return view('frontend.thanks', compact('order', 'status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
        } else {

            $status = 'fail';

            return view('frontend.thanks', compact('status', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
        }
    }

    private function sendOrderConfirmationEmail($order, $orderDetails)
    {
        $to = $order->email; // 確保訂單中有 email 欄位
        $subject = '感謝您訂購商品';

        // 使用 HTML 格式構建郵件內容
        $message = "<h1>感謝您訂購商品</h1>";
        $message .= "<table style='width: 100%; border-collapse: collapse;'>";
        $message .= "<p>若您於垃圾信件中收到此通知，請點選上方「這不是垃圾信」的按鍵或將選擇「加入通訊錄」。</p>";
        $message .= "<tr><th style='border: 1px solid #ddd; padding: 8px;'>商品名稱</th><th style='border: 1px solid #ddd; padding: 8px;'>數量</th><th style='border: 1px solid #ddd; padding: 8px;'>價格</th><th style='border: 1px solid #ddd; padding: 8px;'>材質</th></tr>";

        foreach ($orderDetails as $detail) {
            $message .= "<tr>";
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->name}</td>"; // 假設有 product_name 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->qty}</td>"; // 假設有 quantity 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->price}</td>"; // 假設有 price 屬性
            $message .= "<td style='border: 1px solid #ddd; padding: 8px;'>{$detail->items}</td>"; // 假設有 price 屬性
            $message .= "</tr>";
        }

        $message .= "</table>";

        $message .= "<p style='text-align: center;'><a href='https://wingx.shop/order/list' style='display: inline-block; background-color: #6a5acd; color: white; padding: 10px 20px; text-align: center; text-decoration: none; border-radius: 5px;'>訂單查詢</a></p>"; // 新增的按鈕

        // 使用 Mail::html 發送 HTML 郵件
        Mail::html($message, function ($mail) use ($to, $subject) {
            $mail->to($to)
                ->subject($subject);
        });
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

        // csv_store_id 來取得店家資訊
        $cvs_store_id = $order->cvs_store_id;
        $storeDetails = CvsStoreDetail::where('store_id', $cvs_store_id)->first();

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
                'storeDetails'
            )
        );
    }
}
