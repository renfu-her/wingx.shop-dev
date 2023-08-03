<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductOrderController extends Controller
{
    // product 以及 product_category 的資料
    public function index()
    {
        $product_category = ProductCategory::get();
        foreach ($product_category as $key => $value) {
            $product_category[$key]['product'] = Product::where('category_id', $value['id'])->get();
        }
        return response()->json($product_category);
    }
}
