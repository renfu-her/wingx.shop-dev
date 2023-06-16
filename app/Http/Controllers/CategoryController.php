<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

use App\Services\CartService;

class CategoryController extends Controller
{

        // 分類頁
        public function index(Request $request, $category_id = 0)
        {

            $req = $request->all();

            // category_id = 0，代表全部
            $category_id = $category_id == 0 ? 0 : $category_id;
            if($category_id == 0) {
                $products = Product::paginate(24);
            } else{
                $products = Product::where('category_id', $category_id)->paginate(24);
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

            $total = 0;
            $tax = 0;
            $cart = (new CartService())->getCartAll();
            foreach($cart as $key => $value){
                $total += $value['prod_price'] * $value['qty'];
                $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
            }


            $cart_count = (new CartService())->getCart();
            $cart_count = json_decode($cart_count->getContent(), true);

            return view('frontend.category',
                compact('products', 'product_categories',
                        'cart_count', 'cart', 'total', 'tax'));
        }
}
