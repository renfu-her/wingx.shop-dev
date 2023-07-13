<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Qa;

use App\Services\CartService;

class QAController extends Controller
{

    // q&a list
    public function index(Request $request)
    {

        $req = $request->all();

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $req = $request->all();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $ships = $this->getShipAll();

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        $qas = Qa::orderByDesc('order')->get();
        return view('frontend.qa',
            compact('qas', 'products', 'product_categories', 'cart_count', 'total', 'tax', 'ships'));
    }
}
