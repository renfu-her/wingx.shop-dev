<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\MailNotify;
use App\Models\Member;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;

use DB;
use Log;
use Str;

class MailNotifyService extends BaseService
{
    private $bcc_list = ['renfu.her@gmail.com'];
    public $to_email = 'renfu.her+register@gmai.com';

    /**
     * Email 驗證
     */
    public function email_verify(int $member_id = 0)
    {

        // 驗證 MailNotify 取得內容
        $mailNotify = MailNotify::find(1);

        $member = Member::find($member_id);
        $content = $mailNotify->content;
        $website =  config('app.url') . '/verify_email?email=' . urlencode($member->email) . '&code=' . $member->email_verify;
        $content = str_replace(
            ["\n", '{name}', '{website}'],
            ["<br>", $member->username, $website],
            $content
        );

        $data = [
            'email' => trim($member->email),
            'content' => $content,
            'subject' => $mailNotify->subject,
        ];

        Mail::send('frontend.email.email_verify', $data, function ($message) use ($data) {
            $message->to($data['email'])->bcc($this->bcc_list)
                ->subject($data['subject']);
        });
    }

}
