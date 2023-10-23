<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Ship;

class ProductController extends Controller
{
    // 產品首頁
    public function index(Request $request)
    {

        $req = $request->all();
        $category_id = $req['category_id'] ?? '';
        $prod_name = $req['prod_name'] ?? '';

        $products = Product::orderByDesc('id');

        if (isset($category_id) && $category_id != '') {
            $products = $products->where('category_id', $req['category_id']);
        }
        if (isset($prod_name) && $prod_name != '') {
            $products = $products->where('name', 'like', '%' . $req['prod_name'] . '%');
        }

        $products = $products->orderByDesc('id')->get();

        foreach ($products as $product) {
            $product->category_name = ProductCategory::where('id', $product->category_id)->value('name');
            if ($product->define_image == 1)
                $product->image_url = asset('upload/images/' . $product->id . '/' . $product->image);
            else
                $product->image_url = 'https://down-tw.img.susercontent.com/file/' . $product->image;

            $product->is_free_ship_name = $product->is_free_ship == 1 ? '啟用' : '停用';
        }

        $product_categories = ProductCategory::orderBy('id')->get();

        $ships = [];
        $ship_arr = Ship::where('status', 1)->get();
        foreach ($ship_arr as $ship) {
            $ships[$ship->id] = $ship->name;
        }

        $ship_ids = explode(',', $product->ships);

        return view(
            'backend.product.index',
            compact(
                'products',
                'product_categories',
                'category_id',
                'prod_name',
                'ships',
                'ship_ids'
            )
        );
    }

    // 產品新增頁面
    public function create(Request $request)
    {
        $product_categories = ProductCategory::orderBy('id')->get();
        $product_category = [];
        foreach ($product_categories as $key => $value) {
            $product_category[($key + 1)] = $value->name;
        }

        $ships = [];
        $ship_arr = Ship::where('status', 1)->get();
        foreach ($ship_arr as $ship) {
            $ships[$ship->id] = $ship->name;
        }


        return view('backend.product.create', compact('product_category', 'ships'));
    }

    // 產品新增儲存
    public function store(Request $request)
    {

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->store_number = $request->store_number;
        // $product->price_max = $request->price_max;
        // $product->price_min = $request->price_min;
        $product->description = $request->description;

        if (!empty($request->ships)) {
            $product->ships = implode(',', $request->ships);
        } else {
            $product->ships = '';
        }
        $product->status = $request->status;
        // $product->is_free_ship = $request->is_free_ship;

        $product->save();
        $productId = $product->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = Product::find($productId);
            $file = $request->file('image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('upload/images/' . $productId), $imageName);
            $menuImage->image = $imageName;
            $menuImage->define_image = 1;
            $menuImage->save();
        }



        return redirect('/backend/product');
    }

    // 產品編輯頁面
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $product_categories = ProductCategory::orderBy('id')->get();
        $product_category = [];
        foreach ($product_categories as $key => $value) {
            $product_category[($key + 1)] = $value->name;
        }

        $ships = [];
        $ship_arr = Ship::where('status', 1)->get();
        foreach ($ship_arr as $ship) {
            $ships[$ship->id] = $ship->name;
        }

        $ship_ids = explode(',', $product->ships);

        return view(
            'backend.product.edit',
            compact('product', 'product_category', 'ships', 'ship_ids')
        );
    }

    // 產品編輯儲存
    public function update(Request $request, $productId)
    {

        $product = Product::find($productId);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->store_number = $request->store_number;
        // $product->price_max = $request->price_max;
        // $product->price_min = $request->price_min;
        $product->description = $request->description;
        // $product->define_image = 1;
        // $product->is_free_ship = $request->is_free_ship;
        $product->status = $request->status;
        if (!empty($request->ships)) {
            $product->ships = implode(',', $request->ships);
        } else {
            $product->ships = '';
        }
        $product->save();

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = Product::find($productId);
            $file = $request->file('image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('upload/images/' . $productId), $imageName);
            $menuImage->image = $imageName;
            $menuImage->define_image = 1;
            $menuImage->save();
        }


        return redirect('/backend/product');
    }

    // 產品刪除
    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/backend/product');
    }
}
