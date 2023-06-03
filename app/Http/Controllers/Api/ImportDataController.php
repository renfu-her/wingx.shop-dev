<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

class ImportDataController extends Controller
{

    public function index($product_id){

        $json_file = base_path($product_id);

        $json = file_get_contents($json_file);

        $data = json_decode($json, true);

        $items = $data['items'];

        foreach($items as $item){
            $item_basic = $item['item_basic'];

            $product = new Product();
            $product->item_id = $item_basic['itemid'];
            $product->name = $item_basic['name'];
            $product->price = $item_basic['price'];
            $product->price_max = $item_basic['price_max'];
            $product->price_min = $item_basic['price_min'];
            $product->image = $item_basic['image'];
            $product->status = $item_basic['status'];

            $product->save();

            $product_id = $product->id;

            $idx = 1;
            foreach($item_basic['images'] as $image){
                $product_image = new ProductImage();
                $product_image->product_id = $product_id;
                $product_image->image = $image;
                $product_image->sort = $idx;
                $product_image->save();

                $idx++;
            }

        }

    }
}
