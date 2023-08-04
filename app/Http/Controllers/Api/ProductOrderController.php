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
        $product_category = ProductCategory::on('mysql_second')->get();
        foreach ($product_category as $key => $value) {
            $product_category[$key]['product'] =
                Product::on('mysql_second')
                ->where('category_id', $value['id'])
                ->where('status', 1)
                ->get();
        }
        return response()->json($product_category);
    }
}
