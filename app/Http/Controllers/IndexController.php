<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

class IndexController extends Controller
{

    // 首頁
    public function index()
    {
        $products = Product::all();
        $product_images = ProductImage::all();
        $product_categories = ProductCategory::all();

        return view('frontend.index', compact('products', 'product_images', 'product_categories'));
    }

}
