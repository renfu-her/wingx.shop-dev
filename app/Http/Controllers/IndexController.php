<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Banner;

class IndexController extends Controller
{

    // 首頁
    public function index()
    {
        $products = Product::inRandomOrder()->where('category_id', 1)->take(20)->get();
        foreach($products as $key => $value){
            if($value->define_image == 0){
                $products[$key]->image_url = 'https://down-tw.img.susercontent.com/file/' .$value->image;
            } else {
                $products[$key]->image_url = asset('upload/images/' . $value->id . '/' . $value->image);
            }
        }

        $products3 = Product::inRandomOrder()->where('category_id', 3)->take(20)->get();
        foreach($products3 as $key => $value){
            if($value->define_image == 0){
                $products3[$key]->image_url = 'https://down-tw.img.susercontent.com/file/' .$value->image;
            } else {
                $products3[$key]->image_url = asset('upload/images/' . $value->id . '/' . $value->image);
            }
        }

        $product_images = ProductImage::all();
        $product_categories = ProductCategory::all();
        $banners = Banner::orderByDesc('id')->get();

        return view('frontend.index',
            compact('products',
                    'product_images',
                    'product_categories',
                    'banners',
                    'products3'
                    )
        );
    }

}
