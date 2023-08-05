<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;

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

    // product 的圖檔
    public function productImage($id)
    {
        $product_image = ProductImage::on('mysql_second')
            ->where('product_id', $id)
            ->get();
        foreach ($product_image as $key => $value) {
            $product_image[$key]['image'] = "https://down-tw.img.susercontent.com/file/" . $value['image'];
        }
        return response()->json($product_image);
    }
}
