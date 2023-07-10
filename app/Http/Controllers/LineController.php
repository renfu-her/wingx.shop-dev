<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LineController extends Controller
{
    public function lineLogin()
    {
        return Socialite::driver('line')->redirect();
    }

    public function lineLoginCallback()
    {
        $user = Socialite::driver('line')->user();

        $obj = Member::updateOrCreate(
            ['line_id' => $user->id],
            [
                'name' => $user->name,
                'nick_name' => $user->nickname,
                // 'email' => $user->email,
                'password' => Hash::make('Qq123456'),
                'status' => 1,
            ]
        );

        $member = Member::find($obj->id);

        // 登入 member id
        session()->put('member_id', $member->id);

        return redirect('/');
    }
}
