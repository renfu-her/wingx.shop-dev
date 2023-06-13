<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

class OrderController extends Controller
{

    // 訂單數量
    public function cartCount(Request $request){

        $cartService = (new CartService())->getCart();

        return $cartService;

    }
}
