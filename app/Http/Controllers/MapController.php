<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\OrderLogistics;

use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // rewrite
    public function rewrite(Request $request)
    {
        $res = $request->all();
        $memberId = $res['memberId'] ?? null;

        if (empty($memberId) || empty($res['CVSStoreID'])) {
            return response()->json([
                'status' => 'failed',
                'message' => '門市資料不完整',
            ], 422);
        }

        $logistics = OrderLogistics::updateOrCreate([
            'member_id' => $memberId
        ], [
            'logistics_sub_type' => $res['LogisticsSubType'] ?? null,
            'cvs_store_id' => $res['CVSStoreID'],
            'cvs_store_name' => $res['CVSStoreName'] ?? null,
            'cvs_address' => $res['CVSAddress'] ?? null,
            'cvs_telephone' => $res['CVSTelephone'] ?? null,
            'cvs_out_side' => $res['CVSOutSide'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $logistics,
        ]);
    }
}
