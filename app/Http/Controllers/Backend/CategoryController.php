<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService as Service;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    // index
    public function index(Request $request)
    {
        $productCategory = (new Service($request))->list();

        return view(
            'backend/category/index',
            compact('productCategory')
        );
    }
    // store
    public function edit(Request $request, $id)
    {
        $category =  ProductCategory::find($id);

        return view(
            'backend/category/edit',
            compact('category')
        );
    }
    // update
    public function update(Request $request, $id)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['_method']);

        ProductCategory::where($data)->update(['id' => $id]);

        return redirect('/backend/productCategory');

    }
    // destroy
    public function delete(Request $request, $id)
    {

        ProductCategory::where('id', $id)->delete();

        return redirect('/backend/productCategory');
    }
}
