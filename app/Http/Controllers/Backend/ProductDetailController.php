<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductDetailService as Service;


class ProductDetailController extends Controller
{

    
    // index
    public function edit(Request $request, $product_id)
    {

        return (new Service($request, $product_id))
                ->edit();
    }
    // store
    public function store(Request $request)
    {
        return (new Service($request))
                ->store();
    }
    // // update
    // public function update(Request $request, $id)
    // {
    //     return (new Service($request, $id))
    //             ->runValidate('update')
    //             ->update()
    //             ->getResponse();
    // }
    // // destroy
    // public function destroy(Request $request, $id)
    // {
    //     return (new Service($request, $id))
    //             ->destroy()
    //             ->getResponse();
    // }
}