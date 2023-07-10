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

class LineController extends Controller
{
    public function lineLogin()
    {
        return Socialite::driver('line')->redirect();
    }

    public function lineLoginCallback()
    {
        $user = Socialite::driver('line')->user();

        $member = Member::updateOrCreate(
            ['line_id' => $user->id],
            [
                'username' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('Qq123456'),
                'status' => 1,
            ]
        );

        // 登入 member id
        session()->put('member_id', $member->id);

        return redirect('/');

    }

}
