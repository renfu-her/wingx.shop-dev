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
    

        dd();
        $mapHttp = Http::post(env('EXPRESS_MAP_URL'), [
            "MerchantID" => env('EXPRESS_MERCHANT_ID'),
            "LogisticsType" => "CSV",
            "LogisticsSubType" => "FAMIC2C",
            "IsCollection" => "N",
            "ServerReplyURL" => "https://wingx-shop.dev-laravel.co/checkout"
        ]);
    
        dd($mapHttp);
    }
    
}