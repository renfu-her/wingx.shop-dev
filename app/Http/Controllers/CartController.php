<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // cart
    public function index(){
        return view('cart');
    }

    // cart order
    public function order(Request $request){

        $req = $request->all();

        $cart = [
            'dataBase' => $req['dataBase'],
            'prod_id' => $req['prod_id'],
            'price' => $req['price'],
            'qty' => $req['qty'],
        ];

        session()->put('cart', $cart);
        

        //return redirect('/cart')->with(['success' => '已經加入購物車']);
    }
}
