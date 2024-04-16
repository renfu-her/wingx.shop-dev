<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // rewrite
    public function rewrite(Request $request, $sessionId)
    {
        $dataArray = $request->all();
        // 轉換為 JSON 字符串
        $dataArrayJson = json_encode($dataArray);

        // session id
        session()->setId($sessionId);
        dd($sessionId, $dataArrayJson);
        
        return view('frontend.mapReturn', compact('dataArrayJson'));
        
    }
}
