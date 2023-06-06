<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

class ProductImageController extends Controller
{
    // 產品圖片管理頁面
    public function index(Request $request, $product_id)
    {
        $product_images = ProductImage::where('product_id', $product_id)->get();
        foreach ($product_images as $product_image) {
            if($product_image->define_image == 0){
                $product_image->image_url = 'https://down-tw.img.susercontent.com/file/' .$product_image->image;
            } else {
                $product_image->image_url = asset('upload/images/' . $product_image->product_id . '/' . $product_image->image);
            }
        }

        return view('backend.productImage.index', [
            'product_images' => $product_images,
            'product_id' => $product_id,
        ]);
    }

    // 新增產品圖片頁面
    public function create(Request $request, $product_id)
    {
        return view('backend.productImage.create', [
            'product_id' => $product_id,
        ]);
    }

    // 新增產品圖片
    public function store(Request $request, $product_id)
    {
        $req = $request->all();

        $product_image = new ProductImage;
        $product_image->product_id = $product_id;
        $product_image->sort = $req['sort'];
        $product_image->define_image = 1;
        $product_image->save();

        $product_image_id = $product_image->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = ProductImage::find($product_image_id);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/images/' . $product_id), $imageName);
            $menuImage->image = $imageName;
            $menuImage->save();
        }

        return redirect('/backend/product/image/' . $product_id);
    }

    // 編輯產品圖片頁面
    public function edit(Request $request, $product_id, $product_image_id)
    {
        $product_image = ProductImage::find($product_image_id);
        $product = Product::find($product_id);

        return view('backend.productImage.edit',
            compact('product_image', 'product_id', 'product_image_id', 'product'));
    }

    // 更新產品圖片
    public function update(Request $request, $product_image_id)
    {
        $req = $request->all();

        $product_image = ProductImage::find($product_image_id);
        $product_image->sort = $req['sort'];
        $product_image->define_image = 1;
        $product_image->save();

        $product_id = $product_image->product_id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $menuImage = ProductImage::find($product_image_id);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/images/' . $product_id), $imageName);
            $menuImage->image = $imageName;
            $menuImage->save();
        }

        return redirect('/backend/product/image/' . $product_image->product_id);
    }

    // 刪除產品圖片
    public function delete(Request $request, $product_image_id)
    {
        $product_image = ProductImage::find($product_image_id);
        $product_image->delete();

        return redirect('/backend/product/image/' . $product_image->product_id);
    }
}
