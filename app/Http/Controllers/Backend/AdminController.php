<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminController extends Controller
{
    // 首頁轉址
    public function backendTo(Request $request)
    {
        return redirect('/backend/product');
    }

    // 管理者首頁
    public function index(Request $request)
    {

        $users = User::all();
        return view('backend.admin.index', compact('users'));
    }

    // 管理者新增頁面
    public function create(Request $request)
    {
        return view('backend.admin.create');
    }

    // 管理者新增儲存
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email =$request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/backend/admin');
    }

    // 管理者編輯頁面
    public function edit(Request $request, $user_id)
    {
        $user = User::find($user_id);

        return view('backend.admin.edit', compact('user'));
    }

    // 管理者編輯儲存
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email =$request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('/backend/admin');
    }

    // 管理者刪除
    public function delete(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return redirect('/backend/admin');
    }
}
