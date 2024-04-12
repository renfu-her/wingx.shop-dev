<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // index
    public function index(Request $request)
    {

        // dd(env('EXPRESS_MAP_URL'), env('EXPRESS_MERCHANT_ID'));
        $response = Http::asForm()
            ->withHeaders([
                'Accept' => 'text/html',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->post('https://logistics-stage.ecpay.com.tw/Express/map', [
                'MerchantID' => '2000933',
                'LogisticsType' => 'CVS',
                'LogisticsSubType' => 'UNIMARTC2C',
                'IsCollection' => 'N',
                'ServerReplyURL' => 'https://wingx-shop.dev-laravel.co/cart/rewrite',
            ]);


        dd($response->body());
    }

    public function rewrite(Request $request)
    {

        dd($request->all());
    }
}
