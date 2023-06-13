<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Product;
use App\Models\ProductCategory;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getProductCategory(){
        $product_categories = ProductCategory::orderBy('sort')->get();

        return $product_categories;
    }

    public function getProduct(){
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

        return $products;
    }
}
