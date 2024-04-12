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
        $mapHttp = Http::asForm()->post(config('config.EXPRESS_MAP_URL'), [
            "MerchantID" => config('config.EXPRESS_MERCHANT_ID'),
            "LogisticsType" => "CSV",
            "LogisticsSubType" => "FAMIC2C",
            "IsCollection" => "N",
            "ServerReplyURL" => route('cart.map.rewrite')
        ]);

    }

    public function rewrite(Request $request)
    {

        dd($request->all());
    }
    
}