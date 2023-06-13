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

        $products = [];
        $product_categories = ProductCategory::orderBy('sort')->get();
        foreach ($product_categories as $key => $value) {

            $products[$key] = [];

            $pd = Product::inRandomOrder()->where('category_id', $value->id)->take(20)->get();
            if(count($pd) > 0){
                foreach ($pd as $k => $v) {
                    $products[$key][$k] = $v;
                    if ($v->define_image == 0) {
                        $products[$key][$k]['image_url'] = 'https://down-tw.img.susercontent.com/file/' . $v->image;
                    } else {
                        $products[$key][$k]['image_url'] = asset('upload/images/' . $v->id . '/' . $v->image);
                    }
                }
            }

        }

        $banners = Banner::orderByDesc('id')->get();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach($cart as $key => $value){
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
            $cart[$key]['sub_total'] = $value['prod_price'] * $value['qty'];
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
