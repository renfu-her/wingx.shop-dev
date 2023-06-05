<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 首頁轉址
    public function index(Request $request)
    {
        return redirect('/backend/product');
    }
}
