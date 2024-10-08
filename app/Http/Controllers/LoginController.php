<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Banner;

use App\Services\MailNotifyService;
use App\Services\CartService;

class LoginController extends Controller
{
    // 登入頁面，檢查是否有登入過
    public function index()
    {

        $products = [];
        $product_categories = ProductCategory::orderBy('sort')->get();
        foreach ($product_categories as $key => $value) {

            $products[$key] = [];

            $pd = Product::inRandomOrder()->where('category_id', $value->id)->take(20)->get();
            if (count($pd) > 0) {
                foreach ($pd as $k => $v) {
                    $products[$key][$k] = $v;
                    if ($v->define_image == 0) {
                        $products[$key][$k]['image_url'] = 'https://down-tw.img.susercontent.com/file/' . $v->image;
                    } else {
                        $products[$key][$k]['image_url'] = asset('upload/images/' . $v->id . '/' . $v->image);
                    }
                }
            }
        }

        $banners = Banner::orderByDesc('id')->get();

        if (auth()->check()) {
            return redirect('/');
        }
        return view('frontend.login', compact('products', 'product_categories', 'banners'));
    }

    // 註冊檢查
    public function signUp(Request $request)
    {

        $req = $request->all();

        $validator = validator($req, [
            'signup_email' => 'required|email',
            'signup_username' => 'required|string',
            'signup_password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect('/')->with(['message' => '驗證碼輸入錯誤，請重新註冊']);
        }
        $email = trim($req['signup_email']);
        $name = trim($req['signup_username']);
        $password = trim($req['signup_password']);
        $status = 0;
        $email_verify = $this->generator_email_verify();

        $member = Member::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'status' => $status,
            'email_verify' => $email_verify,
        ]);

        $member_id = $member->id;

        $mailNotifyService = (new MailNotifyService())->email_verify($member_id);

        return redirect('/')->with(['message' => '請至信箱收信認證你的E-mail，才算完成註冊，謝謝！(備註：若未收到認證信，請至垃圾郵件查看或至登入頁重發認證信)']);
    }

    // 登入
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 檢查會員是否存在
        $member = Member::where('email', $request->email)->first();

        if (!$member) {
            return redirect('/')->with('message', 'Email 輸入錯誤');
        }

        // 檢查會員狀態
        if ($member->status != 1) {
            return redirect('/')->with('message', 'E-mail尚未認證，請至信箱收信或重發認證信');
        }

        // 嘗試登入
        if (Auth::guard('member')->attempt($credentials)) {
            
            // dd(session()->regenerate(), auth()->guard('member')->user());
            session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => '提供的憑據不匹配我們的記錄。',
        ]);
    }


    // check email exist
    public function check_email(Request $request)
    {

        $input = $request->all();

        $email = $input['email'];

        $member = Member::where('email', $email)->first();

        if ($member) {
            return response()->json(['code' => 200, 'data' => $member]);
        } else {
            return response()->json(['code' => 100, 'data' => '']);
        }
    }

    // 重發認證信
    public function reset_verify_password(Request $request)
    {

        $input = $request->all();
        $verify = $input['verify'];


        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $banners = Banner::orderByDesc('id')->get();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        $member = Member::where('email_verify', $verify)
            ->first();
        if ($member) {

            return view(
                'frontend.email.reset_password',
                compact('verify', 'products', 'product_categories', 'banners', 'total', 'tax', 'cart_count')
            );
        } else {
            return redirect('/')->with(['message' => 'Email或者驗證碼輸入錯誤']);
        }
    }

    // 驗證密碼
    public function verify_password(Request $request)
    {

        $input = $request->all();

        $password = $input['password'];
        $verify = $input['verify'];

        $member = Member::where('email_verify', $verify)->first();
        $member->password = Hash::make($password);
        $member->email_verify = '';
        $member->save();

        return redirect('/')->with(['message' => '密碼已經更新完成，請重登入']);
    }

    // 忘記密碼
    public function reset_password(Request $request)
    {

        $input = $request->all();

        $email = $input['reset_email'];

        $member = Member::where('email', $email)->first();

        if (!$member) {
            return redirect('/')->with(['message' => 'Email 不存在']);
        }

        $random_code = $this->generator_email_verify();
        $data = ['email_verify' => $random_code, 'email' => $member->email];
        $to_email = $member->email;
        Mail::send('frontend.email.reset', $data, function ($message) use ($to_email) {
            $message->to($to_email)
                ->subject('忘記密碼');
        });

        $member->email_verify = $random_code;
        $member->save();

        return redirect('/')->with(['message' => '重置密碼信件已經寄出，請收信']);
    }

    // email 驗證碼驗證
    public function verify_email(Request $request)
    {

        $req = $request->all();
        $code = $req['code'];
        $email = $req['email'];

        $member = Member::where('email', $email)->where('email_verify', $code)->first();

        if ($member) {
            $member->status = 1;
            $member->save();

            return redirect('/')->with(['message' => '驗證成功，請回到首頁重新登入']);
        } else {

            return redirect('/')->with(['message' => '驗證不成功，請再檢查，謝謝！']);
        }
    }

    // 產生 member email 驗證碼
    public function email_verify(Request $request)
    {

        $input = $request->all();

        $email = $input['email_verify'];

        if (!$email) {
            return redirect('/')->with(['message' => 'E-mail 不存在']);
        }

        $member = Member::where('email', $email)->first();

        if (!$member) {
            return redirect('/')->with(['message' => 'E-mail 不存在']);
        }

        if (!$member->deleted_at) {
            if ($member->enabled == 1) {
                return redirect('/')->with(['message' => 'E-mail 已經驗證成功過，請重新登入']);
            } else {
                $member_id = $member->id;

                $member_data = Member::find($member_id);
                $member_data->email_verify = $this->generator_email_verify();
                $member_data->save();

                $mailNotifyService = new MailNotifyService();
                $mailNotifyService->email_verify($member_id);

                return redirect('/')->with(['message' => '重新發送驗證信到你的信箱，請依照連結做驗證你的 E-mail']);
            }
        }
    }

    // 產生 email 驗證碼
    private function generator_email_verify()
    {
        $str = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";

        $random = substr(str_shuffle($str), 26, 20);

        return $random;
    }

    // LINE 合併 Email 的驗證
    public function lineCombine(Request $request)
    {

        $req = $request->all();
    }
}
