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

    // cart checkout
    public function checkout(Request $request){

        $member_id = session()->get('member_id');

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $req = $request->all();
        $req['member_id'] = $member_id;

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach($cart as $key => $value){
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        return view('frontend.checkout',
            compact('products','product_categories', 'cart', 'total', 'tax')
        );


    }
}
