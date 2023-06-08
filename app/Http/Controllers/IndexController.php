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


        // $products3 = Product::inRandomOrder()->where('category_id', 3)->take(20)->get();
        // foreach ($products3 as $key => $value) {
        //     if ($value->define_image == 0) {
        //         $products3[$key]->image_url = 'https://down-tw.img.susercontent.com/file/' . $value->image;
        //     } else {
        //         $products3[$key]->image_url = asset('upload/images/' . $value->id . '/' . $value->image);
        //     }
        // }

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

        // dd($products);

        $banners = Banner::orderByDesc('id')->get();

        return view(
            'frontend.index',
            compact(
                'products',
                'product_images',
                'product_categories',
                'banners',
            )
        );
    }
}
