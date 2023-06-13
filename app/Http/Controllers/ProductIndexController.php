<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductMix;

use App\Services\CartService;

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

        $productMix = ProductMix::where('product_id', $product_id)->orderBy('sort')->get();
        foreach ($productMix as $key => $value) {
            $product_name = [];
            $product_name[0] = $product->name;
            $product_mix1 = Product::find($value->product_mix1);
            $product_mix2 = Product::find($value->product_mix2);
            $product_name[1] = $product_mix1->name;
            if($product_mix2){
                $product_name[2] = $product_mix2->name;
            }
            $productMix[$key]->product_name = implode(' ＋ ', $product_name);
        }

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach($cart as $key => $value){
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        return view('frontend.product',
            compact('product',
            'product_category',
            'product_images',
            'product_categories',
            'productMix',
            'cart' ,
            'total',
            'tax',
            )
        );
    }
}
