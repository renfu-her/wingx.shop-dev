<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Policy;

class PolicyAdminController extends Controller
{

    public function getPolicy($index)
    {
        $data = Policy::find($index);
        $data->content = Str::markdown($data->content);
        if (!$data) {
            return response()->json(['message' => '文章不存在'], 404);
        }
        return response()->json($data, 200);
    }
}
