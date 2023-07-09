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

class LineController extends Controller
{
    public function lineLogin()
    {
        return Socialite::driver('line')->redirect();
    }

    public function lineLoginCallback()
    {
        $user = Socialite::driver('line')->user();
        dd($user);

    }

}
