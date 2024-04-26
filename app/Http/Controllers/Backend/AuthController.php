<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{

    // 登入頁面
    public function login(Request $request)
    {

        return view('backend.login.login');
    }

    // 登入驗證
    public function login_verify(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            // dd(Auth::check());
            return redirect('/backend/product');
        } else {
            return redirect()->back()->with(['message' => '帳號或者密碼輸入錯誤']);
        }
    }

    // 登出
    public function logout(Request $request)
    {
        session()->forget(['userId', 'userEmail', 'userName']);

        return redirect('/backend/login');
    }
}
