<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderShipService as Service;
class OrderShipController extends Controller
{
    // index
    public function index(Request $request)
    {
        return (new Service($request))
                ->list()
                ->getResponse();
    }
    // store
    public function store(Request $request)
    {
        return (new Service($request))
                ->runValidate('store')
                ->store()
                ->getResponse();
    }
    // update
    public function update(Request $request, $id)
    {
        return (new Service($request, $id))
                ->runValidate('update')
                ->update()
                ->getResponse();
    }
    // destroy
    public function destroy(Request $request, $id)
    {
        return (new Service($request, $id))
                ->destroy()
                ->getResponse();
    }
}