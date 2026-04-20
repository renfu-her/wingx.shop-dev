<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\CvsStoreDetail;
use App\Models\OrderLogistics;

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
        $paymentResult = $this->syncPaymentResult($req);

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

        $order = $paymentResult['order'];
        $status = $paymentResult['status'];
        $message = $paymentResult['message'];

        if ($status === 'success') {
            session()->forget('cart');
        }

        return view('frontend.thanks', compact('order', 'status', 'message', 'products', 'product_categories', 'cart', 'total', 'tax', 'ships', 'cart_count'));
    }

    public function paymentNotify(Request $request)
    {
        $paymentResult = $this->syncPaymentResult($request->all());

        if ($paymentResult['status'] === 'success') {
            return response('1|OK', 200)->header('Content-Type', 'text/plain');
        }

        return response('0|' . $paymentResult['message'], 200)->header('Content-Type', 'text/plain');
    }

    private function syncPaymentResult(array $data)
    {
        $orderNo = $this->resolvePaymentOrderNo($data);

        if (empty($orderNo)) {
            return [
                'status' => 'fail',
                'message' => '缺少訂單編號',
                'order' => null,
            ];
        }

        $order = Order::where('order_no', $orderNo)->first();
        if (!$order) {
            return [
                'status' => 'fail',
                'message' => '查無對應訂單',
                'order' => null,
            ];
        }

        $rtnCode = (int)($data['RtnCode'] ?? 0);
        if ($rtnCode !== 1) {
            return [
                'status' => 'fail',
                'message' => $data['RtnMsg'] ?? '訂單未完成，請重新確認您的訂單與付款項目',
                'order' => $order,
            ];
        }

        $wasPaid = (int)$order->status === 1;
        $order->payment = $data['PaymentType'] ?? $order->payment;
        $order->status = 1;
        $order->save();

        if (empty($order->invoice_no)) {
            $ecpayService = new EcPayService();
            $eInvoice = $ecpayService->ecpayInvoice($orderNo);

            if (($eInvoice['TransCode'] ?? null) == 1) {
                $eInvoiceData = $eInvoice['Data'];
                $order->invoice_no = $eInvoiceData['InvoiceNumber'] ?? $eInvoiceData['InvoiceNo'] ?? $order->invoice_no;
                $order->invoice_random_no = $eInvoiceData['RandomNumber'] ?? $order->invoice_random_no;
                $order->save();
            }
        }

        if (!$wasPaid) {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            $this->sendOrderConfirmationEmail($order, $orderDetails);
        }

        return [
            'status' => 'success',
            'message' => $data['RtnMsg'] ?? '已完成訂單，謝謝！',
            'order' => $order,
        ];
    }

    private function resolvePaymentOrderNo(array $data)
    {
        return $data['CustomField1'] ?? $data['MerchantTradeNo'] ?? null;
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
        $result = $this->syncLogisticsReply($request->all());

        if ($result['status'] === 'success') {
            return response('1|OK', 200)->header('Content-Type', 'text/plain');
        }

        return response('0|' . $result['message'], 200)->header('Content-Type', 'text/plain');
    }

    public function clientReply(Request $request)
    {
        $data = $request->all();
        $result = $this->syncLogisticsReply($data);

        if ($result['status'] !== 'success') {
            abort(404, $result['message']);
        }

        $order = $result['order'];

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

        if (($data['LogisticsSubType'] ?? '') == 'FAMIC2C') {
            $logisticsSubType = "全家店到店";
        } else {
            $logisticsSubType = "7-11 交貨便";
        }

        $storeDetails = $result['storeDetails'];

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

    private function syncLogisticsReply(array $data)
    {
        $orderNo = $data['MerchantTradeNo'] ?? null;
        if (empty($orderNo)) {
            return [
                'status' => 'fail',
                'message' => '缺少訂單編號',
                'order' => null,
                'storeDetails' => null,
            ];
        }

        $order = Order::where('order_no', $orderNo)->first();
        if (!$order) {
            return [
                'status' => 'fail',
                'message' => '查無對應訂單',
                'order' => null,
                'storeDetails' => null,
            ];
        }

        if (!empty($data['AllPayLogisticsID'])) {
            $order->pay_logistics_id = $data['AllPayLogisticsID'];
        }
        if (!empty($data['RtnCode'])) {
            $order->logistics_status = $data['RtnCode'];
        }
        if (!empty($data['CVSStoreID'])) {
            $order->cvs_store_id = $data['CVSStoreID'];
        }
        $order->save();

        $storeDetails = null;
        if (!empty($data['CVSStoreID'])) {
            $storeDetails = CvsStoreDetail::updateOrCreate(
                ['store_id' => $data['CVSStoreID']],
                [
                    'store_name' => $data['CVSStoreName'] ?? '',
                    'address' => $data['CVSAddress'] ?? '',
                    'telephone' => $data['CVSTelephone'] ?? '',
                ]
            );
        } elseif (!empty($order->cvs_store_id)) {
            $storeDetails = CvsStoreDetail::where('store_id', $order->cvs_store_id)->first();
        }

        if (!empty($order->member_id)) {
            OrderLogistics::updateOrCreate(
                ['member_id' => $order->member_id],
                [
                    'logistics_sub_type' => $data['LogisticsSubType'] ?? null,
                    'cvs_store_id' => $data['CVSStoreID'] ?? $order->cvs_store_id,
                    'cvs_store_name' => $data['CVSStoreName'] ?? ($storeDetails->store_name ?? null),
                    'cvs_address' => $data['CVSAddress'] ?? ($storeDetails->address ?? null),
                    'cvs_telephone' => $data['CVSTelephone'] ?? ($storeDetails->telephone ?? null),
                    'cvs_out_side' => $data['CVSOutSide'] ?? null,
                ]
            );
        }

        return [
            'status' => 'success',
            'message' => $data['RtnMsg'] ?? '物流資料已更新',
            'order' => $order,
            'storeDetails' => $storeDetails,
        ];
    }
}
