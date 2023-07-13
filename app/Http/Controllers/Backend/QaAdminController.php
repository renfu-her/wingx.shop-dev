<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Qa;

class QaAdminController extends Controller
{
    // q&a list
    public function index(Request $request)
    {
        $req = $request->all();

        $qas = Qa::orderByDesc('order')->get();

        return view('backend.qa.index', compact('qas'));
    }

    // q&a create
    public function create(Request $request)
    {
        $req = $request->all();

        return view('backend.qa.create');
    }

    // q&a store
    public function store(Request $request)
    {
        $req = $request->all();

        $qa = Qa::create($req);

        return redirect('/backend/qa');
    }

    // q&a edit
    public function edit(Request $request, $id)
    {
        $req = $request->all();

        $qa = Qa::find($id);

        return view('backend.qa.edit', compact('qa'));
    }

    // q&a update
    public function update(Request $request, $id)
    {
        $req = $request->all();

        $qa = Qa::find($id);
        $qa->update($req);

        return redirect('/backend/qa');
    }

    // q&a delete
    public function delete(Request $request, $id)
    {
        $req = $request->all();

        $qa = Qa::find($id);
        $qa->delete();

        return redirect('/backend/qa');
    }
}
