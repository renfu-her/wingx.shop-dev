<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ship;

class ShipController extends Controller
{
    // ship id to get price
    public function getPrice(Request $request)
    {
        $ship = Ship::find($request->ship_id);
        return $ship->ship_price;
    }
}
