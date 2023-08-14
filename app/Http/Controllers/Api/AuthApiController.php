<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Str;
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
        $user_token = UserToken::where('user_id', $user->id)->where('expired_at', '>', time())->first();
        if ($user_token) {
            return response()->json(['result' => '401', 'data' => ['token' => $user_token->token, 'expired_at' => $user_token->expired_at]], 401);
        } else {

            // 產生 token
            $token = $this->createToken($user);
            return response()->json(['result' => '200', 'data' => ['token' => $token['token'], 'expired_at' => $token['expired_at']]]);
        }
    }

    // user create token
    public function createToken($user)
    {

        $token_time = Str::uuid()->toString();
        $token_time = str_replace('-', '', $token_time);
        // 產生 token
        $token = $user->createToken($token_time)->plainTextToken;

        // 回傳 token
        UserToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'expired_at' => Carbon::now()->addHours(24)->timestamp,
        ]);

        $data = [
            'token' => $token,
            'expired_at' => Carbon::now()->addHours(24)->timestamp,
        ];

        return $data;
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
