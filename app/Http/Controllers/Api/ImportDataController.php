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


        dd($data);

    }
}
