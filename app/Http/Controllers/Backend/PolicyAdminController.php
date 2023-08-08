<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Policy;

class PolicyAdminController extends Controller
{
    // index
    public function index()
    {
        $policies = Policy::orderByDesc('created_at')->get();
        return view('backend.policies.index', compact('policies'));
    }

    // show
    public function show($id)
    {
        $data = Policy::find($id);
        if (!$data) {
            return response()->json(['message' => '文章不存在'], 404);
        }
        return view('backend.policies.show', compact('data'));
    }

    // create
    public function create()
    {
        return view('backend.policies.create');
    }

    // store
    public function store(Request $request)
    {
        $policy = new Policy;
        $policy->name = $request->name;
        $policy->content = $request->content;
        $policy->save();
        return redirect('/backend/policies')->with('message', '新增成功');
    }

    // edit
    public function edit($id)
    {
        $data = Policy::find($id);
        if (!$data) {
            return response()->json(['message' => '文章不存在'], 404);
        }
        return view('backend.policies.edit', compact('data', 'id'));
    }

    // update
    public function update(Request $request, $id)
    {
        $policy = Policy::find($id);
        if (!$policy) {
            return response()->json(['message' => '文章不存在'], 404);
        }
        $policy->name = $request->name;
        $policy->content = $request->content;
        $policy->save();
        return redirect('/backend/policies')->with('message', '更新成功');
    }

    // destroy
    public function delete($id)
    {
        $policy = Policy::find($id);
        if (!$policy) {
            return response()->json(['message' => '文章不存在'], 404);
        }
        $policy->delete();
        return redirect('/backend/policies')->with('message', '刪除成功');
    }
}
