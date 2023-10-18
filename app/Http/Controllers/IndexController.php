<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Banner;

use App\Services\CartService;

class IndexController extends Controller
{

    // 首頁
    public function index()
    {


        $product_images = ProductImage::all();

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $banners = Banner::orderByDesc('id')->get();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            if (!empty($value['prod_price'])) {
                $total += $value['prod_price'] * $value['qty'];
                $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
            }
        }

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        return view(
            'frontend.index',
            compact(
                'products',
                'product_images',
                'product_categories',
                'banners',
                'cart',
                'total',
                'tax',
                'cart_count'
            )
        );
    }
}
