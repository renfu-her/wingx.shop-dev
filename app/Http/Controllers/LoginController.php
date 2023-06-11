<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Banner;

class LoginController extends Controller
{
    // 登入頁面，檢查是否有登入過
    public function index(){

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

        if(auth()->check()){
            return redirect('/');
        }
        return view('frontend.login', compact('products', 'product_categories', 'banners'));
    }
}
