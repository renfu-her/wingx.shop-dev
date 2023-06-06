<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class ProductIndexController extends Controller
{
    // 產品細項，購買訊息的頁面
    public function index(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $product_category = ProductCategory::find($product->category_id);
        $product_categories = ProductCategory::all();

        $product_images = ProductImage::where('product_id', $product_id)->get();
        foreach ($product_images as $product_image) {
            if($product_image->define_image == 0){
                $product_image->image_url = 'https://down-tw.img.susercontent.com/file/' .$product_image->image;
            } else {
                $product_image->image_url = asset('upload/images/' . $product_image->product_id . '/' . $product_image->image);
            }
        }

        return view('frontend.product', [
            'product' => $product,
            'product_category' => $product_category,
            'product_images' => $product_images,
            'product_categories' => $product_categories,
        ]);
    }
}
