<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

class CategoryController extends Controller
{

        // 分類頁
        public function index(Request $request)
        {

            $req = $request->all();
            $category_id = isset($req['category_id']) ? $req['category_id'] : 0;

            if($category_id == 0) {
                $products = Product::paginate(12);
            } else{
                $products = Product::where('category_id', $category_id)->paginate(12);
            }

            $product_categories = ProductCategory::all();
            foreach($product_categories as $product_category){
                $product_count = Product::where('category_id', $product_category->id)->count();
                $product_category->count = $product_count;
            }

            return view('frontend.category', compact('products', 'product_categories'));
        }
}
