<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Banner;

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

        try {
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
            $username = trim($req['signup_username']);
            $password = trim($req['signup_password']);

            // Log::info('=== recommend_code ==='.$recommend_code);
            $member_data['username'] = $username;
            $member_data['email'] = $email;
            $member_data['password'] = Hash::make($password);
            $member_data['status'] = 0;
            $member_data['verify_email'] = $this->generator_email_verify();
            $member = Member::create([
                'username' => $member_data['username'],
                'email' => $member_data['email'],
                'password' => Hash::make($password),
                'status' => $member_data['status'],
                'verify_email' => $member_data['verify_email'],
            ]);

            $member_id = $member->id;

            $mailNotifyService = new MailNotifyService();
            $mailNotifyService->email_verify($member_id);

            return redirect('/')->with(['message' => '請至信箱收信認證你的E-mail，才算完成註冊，謝謝！(備註：若未收到認證信，請至垃圾郵件查看或至登入頁重發認證信)']);
        } catch (\Exception $e) {
            $message = mb_convert_encoding($e->getMessage(), 'utf-8', 'auto');
            $response['message'] = $message;
            Log::error('=== signup ===');
            Log::error($message);
            return redirect('/')->with(['message' => '註冊失敗']);
        }
    }

    private function generator_email_verify()
    {
        $str = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";

        $random = substr(str_shuffle($str), 26, 20);

        return $random;
    }
}
