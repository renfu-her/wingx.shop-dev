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

        $memberId = $res['memberId'];

        OrderLogistics::updateOrCreate([
            'member_id' => $memberId
        ], [
            'logistics_sub_type' => $res['LogisticsSubType'],
            'cvs_store_id' => $res['CVSStoreID'],
            'cvs_store_name' => $res['CVSStoreName'],
            'cvs_address' => $res['CVSAddress'],
            'cvs_telephone' => $res['CVSTelephone'],
            'cvs_out_side' => $res['CVSOutSide']
        ]);
    }
}
