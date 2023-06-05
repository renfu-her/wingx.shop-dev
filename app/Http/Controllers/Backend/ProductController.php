<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class ProductController extends Controller
{
    // 產品首頁
    public function index(Request $request)
    {

        $products = Product::orderByDesl('id')->get();
        foreach($products as $product){
            $product->category_name = ProductCategory::where('id', $product->category_id)->value('name');
            $product->image = ProductImage::where('product_id', $product->id)->value('image');
        }

        $product_categories = ProductCategory::orderBy('id')->get();

        return view('backend.product.index', compact('products', 'product_categories'));
    }

    // 產品新增頁面
    public function create(Request $request)
    {
        $product_categories = ProductCategory::orderBy('id')->get();

        return view('backend.product.create', compact('product_categories'));
    }

    // 產品新增儲存
    public function store(Request $request)
    {

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->price_max = $request->price_max;
        $product->price_min = $request->price_min;
        $product->description = $request->description;
        $product->define_image = 1;
        $product->status = $request->status;
        $product->save();

        $productId = $product->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = Product::find($productId);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/images/' . $productId), $imageName);
            $menuImage->image = $imageName;
            $menuImage->save();
        }

        return redirect('/backend/product');
    }

    // 產品編輯頁面
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $product_categories = ProductCategory::orderBy('id')->get();

        return view('backend.product.edit', compact('product', 'product_categories'));
    }

    // 產品編輯儲存
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->price_max = $request->price_max;
        $product->price_min = $request->price_min;
        $product->description = $request->description;
        $product->define_image = 1;
        $product->status = $request->status;
        $product->save();

        $productId = $product->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = Product::find($productId);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/images/' . $productId), $imageName);
            $menuImage->image = $imageName;
            $menuImage->save();
        }

        return redirect('/backend/product');
    }

    // 產品刪除
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/backend/product');
    }
}