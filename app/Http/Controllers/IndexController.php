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
        foreach($cart as $key => $value){
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

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
            )
        );
    }
}
