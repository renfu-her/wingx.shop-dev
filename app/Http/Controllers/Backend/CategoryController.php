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

    public function create(Request $request)
    {

        return view('backend/category/create');
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

    public function store(Request $request)
    {

        $data = $request->all();

        unset($data['_token']);
        unset($data['_method']);

        $category =  ProductCategory::create($data);

        return redirect('/backend/productCategory');
    }
    // update
    public function update(Request $request, $id)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['_method']);

        ProductCategory::where('id', $id)->update($data);

        return redirect('/backend/productCategory');
    }
    // destroy
    public function delete(Request $request, $id)
    {

        ProductCategory::where('id', $id)->delete();

        return redirect('/backend/productCategory');
    }
}
