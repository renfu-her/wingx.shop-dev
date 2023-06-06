<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;

class BannerController extends Controller
{
    // Banner 首頁
    public function index(Request $request)
    {
        $banners = Banner::all();
        foreach($banners as $key => $value){
            $banners[$key]->image_url = asset('upload/banner/' . $value->image);
            $banners[$key]->status_name = $value->status == 1 ? '啟用' : '停用';
        }
        return view('backend.banner.index', compact('banners'));
    }

    // Banner 新增頁面
    public function create(Request $request)
    {
        return view('backend.banner.create');
    }

    // Banner 新增儲存畫面
    public function store(Request $request)
    {
        $req = $request->all();

        $banner = new Banner;
        $banner->title = $req['title'];
        $banner->sort = $req['sort'];
        $banner->status = $req['status'];
        $banner->save();

        $banner_id = $banner->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $bannerImage = Banner::find($banner_id);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/banner'), $imageName);
            $bannerImage->image = $imageName;
            $bannerImage->save();
        }

        return redirect('backend/banner');
    }

    // Banner 編輯頁面
    public function edit(Request $request, $id)
    {
        $banner = Banner::find($id);
        return view('backend.banner.edit', compact('banner'));
    }

    // Banner 編輯儲存畫面
    public function update(Request $request, $id)
    {
        $req = $request->all();

        $banner = Banner::find($id);
        $banner->title = $req['title'];
        $banner->sort = $req['sort'];
        $banner->status = $req['status'];
        $banner->save();

        $imageName = '';
        if ($request->hasFile('image')) {
            $bannerImage = Banner::find($id);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/banner'), $imageName);
            $bannerImage->image = $imageName;
            $bannerImage->save();
        }

        return redirect('backend/banner');
    }

    // Banner 刪除
    public function destroy(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->delete();

        return redirect('backend/banner');
    }
}
