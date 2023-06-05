<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\News;

class NewsAdminController extends Controller
{
    // 最新消息首頁
    public function index(Request $request)
    {
        $news = News::all();
        foreach($news as $key => $value){
            $news[$key]->status_name = ($value->status == 1) ? '啟用' : '停用';
        }

        return view('backend.news.index', compact('news'));
    }

    // 最新消息新增頁面
    public function create(Request $request)
    {
        return view('backend.news.create');
    }

    // 最新消息新增儲存
    public function store(Request $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->save();

        $newsId = $news->id;

        $imageName = '';
        if ($request->hasFile('image')) {
            $newsImage = News::find($newsId);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/news/images/' . $newsId), $imageName);
            $newsImage->image = $imageName;
            $newsImage->save();
        }

        return redirect('/backend/news');
    }

    // 最新消息編輯頁面
    public function edit(Request $request, $news_id)
    {
        $news = News::find($news_id);

        return view('backend.news.edit', compact('news'));
    }

    // 最新消息編輯儲存
    public function update(Request $request, $newsId)
    {
        $news = News::find($newsId);
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->save();

        $imageName = '';
        if ($request->hasFile('image')) {
            $newsImage = News::find($newsId);
            $file = $request->file('image');
            $imageName = time() .'.'.$file->extension();
            $file->move(public_path('upload/news/images/' . $newsId), $imageName);
            $newsImage->image = $imageName;
            $newsImage->save();
        }

        return redirect('/backend/news');
    }

    // 最新消息刪除
    public function delete(Request $request, $news_id)
    {
        $news = News::find($news_id);
        $news->delete();

        return redirect('/backend/news');
    }
}
