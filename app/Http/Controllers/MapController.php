<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // rewrite
    public function rewrite(Request $request)
    {
        $dataArray = $request->all();
        // session_id($dataArray['sessionID']);
        // session_start();

        $data = [
            'message' => $dataArray
        ];

        // 轉換為 JSON 字符串
        $dataArrayJson = json_encode($data);


        return view('frontend.mapReturn', compact('dataArrayJson'));
    }
}
