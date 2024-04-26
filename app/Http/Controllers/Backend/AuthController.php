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
    public function login(Request $request){

        return view('backend.login.login');
    }

    // 登入驗證
    public function login_verify(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        $data = $request->all();

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return redirect('/')->with(['message' => 'Email 輸入錯誤']);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return redirect('/')->with(['message' => '密碼輸入錯誤']);
        }

        session()->put('userId', $user->id);
        session()->put('userEmail', $user->email);
        session()->put('userName', $user->name);

        return redirect('/backend/product');
        
    }

    // 登出
    public function logout(Request $request)
    {
        session()->forget(['userId', 'userEmail', 'userName']);

        return redirect('/backend/login');
    }
}
