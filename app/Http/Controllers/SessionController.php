<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $sessionId = $request->input('sessionId');

        // 重新載入該 session 的資料
        $sessionData = $this->getSessionData($sessionId);

        return response()->json(['success' => true, 'sessionId' => $sessionId, 'sessionData' => $sessionData]);
    }

    private function getSessionData($sessionId)
    {
        // 根據 Laravel 的 session 存儲方式來讀取 session 資料
        // 假設使用的是默認的文件存儲方式
        $sessionPath = config('session.files') . '/' . $sessionId;

        if (file_exists($sessionPath)) {
            $sessionData = file_get_contents($sessionPath);
            return unserialize($sessionData);
        }

        return null;
    }
}
