<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ship;

class ShipController extends Controller
{
    // ship index
    public function index()
    {
        $ships = Ship::all();
        foreach($ships as $ship){
            $ship['status_name'] = $ship->status == 1 ? '啓用' : '停用';
        }
        return view('backend.ship.index', compact('ships'));
    }

    // ship create
    public function create()
    {
        return view('backend.ship.create');
    }

    // ship store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'ship_price' => 'required'
        ]);

        Ship::create($request->all());

        return redirect()->route('ship.index')->with('success', 'Ship created successfully.');
    }

    // ship edit
    public function edit(Ship $ship)
    {

        $ships = Ship::find($ship);

        return view('backend.ship.edit', compact('ship', 'ships'));
    }

    // ship update
    public function update(Request $request, Ship $ship)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'ship_price' => 'required'
        ]);

        $ship->update($request->all());

        return redirect()->route('ship.index')->with('success', 'Ship updated successfully.');
    }

    // ship destroy
    public function destroy(Ship $ship)
    {

        $ship = Ship::find($ship)->delete();

        return redirect()->route('ship.index')->with('success', 'Ship deleted successfully.');
    }
}