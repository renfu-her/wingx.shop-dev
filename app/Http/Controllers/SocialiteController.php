<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Hash;
use Validator;

class SocialiteController extends Controller
{
    public function fbLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function fbLoginCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }
}
