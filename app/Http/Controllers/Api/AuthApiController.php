<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {

        // 自己寫的驗證
        $email = $request->email ?? '';
        $password = $request->password ?? '';

        if (empty($email) || empty($password)) {
            return response()->json(['message' => 'login email or password incorrect'], 401);
        }

        if ($email) {
            $email_verify = '/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/';
            if (!preg_match($email_verify, $email)) {
                return response()->json(['message' => 'email has incorrect'], 401);
            }
        }


        // 驗證 User 的資料
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['result' => '401', 'data' => ['message' => 'login password incorrect']], 401);
        }
        if (Hash::check($password, $user->password) == false) {
            return response()->json(['result' => '401', 'data' => ['message' => 'login email incorrect']], 401);
        }

        // 檢查 token 是否過期
        $user_token = UserToken::where('user_id', $user->id)->first();
        if ($user_token) {
            if ($user_token->expired_at > Carbon::now()) {
                return response()->json(['result' => '401', 'data' => ['message' => 'token expired']], 401);
            }
        } else {
            $token_time = time();
            // 產生 token
            $token = $user->createToken($token_time)->plainTextToken;

            // 回傳 token
            UserToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expired_at' => Carbon::now()->addHours(24),
            ]);


            return response()->json(['result' => '200', 'data' => ['token' => $token]]);
        }
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {

        dd($request);
    }
}
