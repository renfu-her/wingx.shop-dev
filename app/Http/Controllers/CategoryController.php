<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

class CategoryController extends Controller
{

        // 分類頁
        public function index(Request $request, $category_id = 0)
        {

            $req = $request->all();

            // category_id = 0，代表全部
            $category_id = $category_id == 0 ? 0 : $category_id;
            if($category_id == 0) {
                $products = Product::paginate(12);
            } else{
                $products = Product::where('category_id', $category_id)->paginate(12);
            }

            foreach ($products as $product) {
                if($product->define_image == 0){
                    $product->image_url = 'https://down-tw.img.susercontent.com/file/' .$product->image;
                } else {
                    $product->image_url = asset('upload/images/' . $product->id . '/' . $product->image);
                }
            }

            $product_categories = ProductCategory::all();
            foreach($product_categories as $product_category){
                $product_count = Product::where('category_id', $product_category->id)->count();
                $product_category->count = $product_count;
            }

            return view('frontend.category', compact('products', 'product_categories'));
        }
}
