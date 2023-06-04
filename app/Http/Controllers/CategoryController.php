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
                $products = Product::paginate(10);
            } else{
                $products = Product::where('category_id', $category_id)->paginate(10);
            }

            $product_categories = ProductCategory::all();

            return view('frontend.category', compact('products', 'product_categories'));
        }
}
