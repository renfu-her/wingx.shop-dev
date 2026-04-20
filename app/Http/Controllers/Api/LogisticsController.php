<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderLogistics;

class LogisticsController extends Controller
{
    public function logistics(Request $request)
    {
        $member = auth()->guard('member')->user();
        if (!$member) {
            return response()->json([
                'status' => 'failed',
                'message' => '請先登入會員',
                'data' => []
            ], 401);
        }

        $logistics = OrderLogistics::where('member_id', $member->id)->latest('id')->first();

        if (!empty($logistics)) {
            return response()->json([
                'status' => 'success',
                'data' => $logistics
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
