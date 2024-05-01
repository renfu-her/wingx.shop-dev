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
        
        $data = $request->all();
        
        $user = User::where('email', $data['email'])->where('status', 1)->first();

        if(empty($user)){

            return view('backend.login.login')->with(['error'=>"使用者輸入錯誤或者不存在"]);

        }elseif(Hash::check($data['password'], $user->password)){

            session()->put('userId', $user->id);
            session()->put('userName', $user->name);
            session()->put('userEmail', $user->email);
            return redirect('/backend/product');

        }else{

            return view('backend.login.login')->with(['error'=>"密碼錯誤"]);

        }
    }

    // 登出
    public function logout(Request $request)
    {
        session()->forget(['userId', 'userEmail', 'userName']);

        return redirect('/backend/login');
    }
}
