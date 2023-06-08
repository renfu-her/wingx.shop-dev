<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductMix;

class ProductMixController extends Controller
{
    // 產品組合列表
    public function index(Request $request, $product_id)
    {

        $req = $request->all();

        $product = Product::find($product_id);

        $productMixes = ProductMix::where('product_id', $product_id)->get();
        foreach($productMixes as $key => $value){
            $mix1 = Product::find($value['product_mix1']);
            $mix2 = Product::find($value['product_mix2']);
            $productMixes[$key]['product_mix1_name'] = $mix1->name ?? '';
            $productMixes[$key]['product_mix2_name'] = $mix2->name ?? '';
        }

        return view('backend.productMix.index', compact('product', 'productMixes', 'product_id'));
    }

    // 產品組合新增頁面
    public function create(Request $request, $product_id)
    {
        $req = $request->all();

        $product = Product::find($product_id);
        $product_mix1 = Product::all();
        $product_mix2 = Product::all();

        $product_mix1_selected = [];
        $product_mix2_selected = [];

        foreach($product_mix1 as $key => $value){
            $product_mix1_selected[$value->id] = $value->name;
        }

        foreach($product_mix2 as $key => $value){
            $product_mix2_selected[$value->id] = $value->name;
        }

        return view('backend.productMix.create',
            compact('product', 'product_id', 'product_mix1_selected', 'product_mix2_selected')
        );
    }

    // 產品組合新增
    public function store(Request $request)
    {
        $req = $request->all();

        $productMix = ProductMix::create([
            'product_id' => $req['product_id'],
            'product_mix1' => $req['product_mix1'],
            'product_mix2' => $req['product_mix2'] ?? null,
            'price' => $req['price'],
            'quantity' => 1,
            'description' => $req['description'],
            'status' => $req['status'],
        ]);

        return redirect('/backend/product/mix/' . $req['product_id']);
    }

    // 產品組合編輯頁面
    public function edit(Request $request, $product_id)
    {
        $req = $request->all();

        $product = Product::find($product_id);

        $productMix = ProductMix::find($product_id);

        $product_mix1 = Product::all();
        $product_mix2 = Product::all();

        $product_mix1_selected = [];
        $product_mix2_selected = [];

        foreach($product_mix1 as $key => $value){
            $product_mix1_selected[$value->id] = $value->name;
        }

        foreach($product_mix2 as $key => $value){
            $product_mix2_selected[$value->id] = $value->name;
        }

        return view('backend.productMix.edit', compact('product', 'productMix', 'product_id', 'product_mix1_selected', 'product_mix2_selected'));
    }

    // 產品組合編輯
    public function update(Request $request, $product_id)
    {
        $req = $request->all();

        $productMix = ProductMix::find($product_id);

        $productMix->update([
            'product_mix1' => $req['product_mix1'],
            'product_mix2' => $req['product_mix2'] ?? null,
            'price' => $req['price'],
            'quantity' => 1,
            'description' => $req['description'],
            'status' => $req['status'],
        ]);

        return redirect('/backend/product/mix/' . $product_id);
    }

    // 產品組合刪除
    public function delete(Request $request, $id, $product_id)
    {
        $req = $request->all();

        $productMix = ProductMix::find($id);

        $productMix->delete();

        return redirect('/backend/product/mix/' . $product_id);
    }
}
