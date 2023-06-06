<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\ProductImport;

class ImportDataController extends Controller
{

    // 儲存商品資料
    public function index($product_id){

        $json_file = base_path('importData/' . $product_id);

        $json = file_get_contents($json_file);

        $data = json_decode($json, true);

        $items = $data['items'];

        foreach($items as $item){
            $item_basic = $item['item_basic'];

            $product_exist = Product::where('item_id', $item_basic['itemid'])->first();
            if(!$product_exist){
                $product = new Product();
                $product->item_id = $item_basic['itemid'];
                $product->name = $item_basic['name'];
                $product->price = $item_basic['price'] / 10000;
                $product->price_max = $item_basic['price_max'] / 10000;
                $product->price_min = $item_basic['price_min'] / 10000;
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

    // 儲存商店資料
    public function storeData(){

        $json_file = base_path('importData/shop.json');

        $json = file_get_contents($json_file);

        $data = json_decode($json, true);

        $items = $data['data'];

        $store = new Store();
        $store->name = $items['name'];
        $store->description = $items['description'];
        $store->image = $items['cover'];
        $store->location = $items['shop_location'];
        $store->save();

    }

    // 儲存商品詳細資料
    public function storeDetailData(){

        $productImport = ProductImport::all();

        foreach($productImport as $product){

            $product_data = Product::where('item_id', $product->product_id)->first();
            if($product_data){
                $product_data->description = $product->description;
                $product_data->save();
            }

        }

    }

}
