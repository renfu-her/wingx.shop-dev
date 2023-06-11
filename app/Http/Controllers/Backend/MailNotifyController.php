<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MailNotify;

class MailNotifyController extends Controller
{
    // MailNotify backend index
    public function index()
    {
        $mail_notifies = MailNotify::orderByDesc('id')->get();
        return view('backend.mail_notify.index', compact('mail_notifies'));
    }

    // MailNotify backend create
    public function create()
    {
        return view('backend.mail_notify.create');
    }

    // MailNotify backend store
    public function store(Request $request)
    {
        $req = $request->all();

        $mail_notify = new MailNotify;
        $mail_notify->title = $req['title'];
        $mail_notify->content = $req['content'];
        $mail_notify->save();

        return redirect('/backend/mail_notify')->with(['success' => '已經新增']);
    }

    // MailNotify backend edit
    public function edit($mail_notify_id)
    {
        $mail_notify = MailNotify::find($mail_notify_id);
        return view('backend.mail_notify.edit', compact('mail_notify'));
    }

    // MailNotify backend update
    public function update(Request $request, $mail_notify_id)
    {
        $req = $request->all();

        $mail_notify = MailNotify::find($mail_notify_id);
        $mail_notify->title = $req['title'];
        $mail_notify->content = $req['content'];
        $mail_notify->save();

        return redirect('/backend/mail_notify')->with(['success' => '已經更新']);
    }

    // MailNotify backend delete
    public function delete($mail_notify_id)
    {
        $mail_notify = MailNotify::find($mail_notify_id);
        $mail_notify->delete();

        return redirect('/backend/mail_notify')->with(['success' => '已經刪除']);
    }
}
