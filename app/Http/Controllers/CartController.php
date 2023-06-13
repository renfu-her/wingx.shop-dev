<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

class CartController extends Controller
{
    // cart
    public function index(){
        return view('cart');
    }

    // cart order
    public function order(Request $request){

        $member_id = session()->get('member_id');

        $req = $request->all();
        $req['member_id'] = $member_id;

        $cartService = (new CartService())->cart($req);

        return response()->json([
            'status' => 'success',
            'message' => '已經加入購物車',
        ]);
        
    }
}
