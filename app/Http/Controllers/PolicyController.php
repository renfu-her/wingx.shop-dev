<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;

use App\Models\Policy;
use App\Models\Banner;
use App\Models\ProductImage;

use App\Services\CartService;

class PolicyController extends Controller
{

    // 隱私權政策
    public function privacy_policy()
    {

        $data = Policy::find(1);

        $parser = new Parsedown();
        $content_markdown = $parser->text($data->content);

        $product_images = ProductImage::all();

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $banners = Banner::orderByDesc('id')->get();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach($cart as $key => $value){
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);


        return view(
            'privacy',
            compact('data', 'content_markdown')
        );
    }
}
