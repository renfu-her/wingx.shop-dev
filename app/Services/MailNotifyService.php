<?php

namespace App\Services;

use App\Models\MailNotify;
use App\Models\Member;
use App\Models\Expert;
use App\Models\ExpertService;
use App\Models\ExpertSubject;
use App\Models\ExpertLocation;
use App\Models\ExpertIdentity;
use App\Models\ExpertSchool;
use App\Models\County;
use App\Models\ApplyCount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ClassFund;
use App\Models\ClassMain;
use App\Models\ClassOffical;
use App\Models\ExpertPlan;
use App\Models\Reserve;
use App\Models\RemoteCounsellingEvidence;
use App\Models\ExpertStatus;
use Carbon\Carbon;

use App\Reservation\Reservation;
use Illuminate\Support\Facades\Mail;

use DB;
use Log;
use Str;

class MailNotifyService
{
    private $bcc_list = ['renfu.her@gmail.com'];
    public $to_email = 'renfu.her+rgister@gmai.com';


    /*
    ** 訂單通知
    */
    public function order_notify($order_id)
    {

        $mail_notify = MailNotify::find(1);

        $order = Order::find($order_id);

        $order_detail = OrderDetail::where('order_id', $order_id)->get();
        $items = [];
        foreach ($order_detail as $key => $value) {
            $image = '';
            if ($value['type'] == 1) {
                $class_fund = ClassFund::find($value['fund_id']);
                $class_offical = ClassOffical::find($class_fund->offical_id);
                $class_main = ClassMain::find($class_offical->main_id);
                $title = $class_main->title . '<br>' . $value['title'];
                $image = config('app.url') . '/upload/class/images/' . $class_main->id . '/' . $class_offical->image;
            } else {
                $class_main = ClassMain::find($value['course_id']);
                $class_offical = ClassOffical::where('main_id', $class_main->id)->first();
                $title = $value['title'];
                $image = config('app.url') . '/upload/class/images/' . $class_main->id . '/' . $class_offical->image;
            }

            $items[] = [
                'title' => $title,
                'amount' => $value['amount'],
                'discount' => $value['discount'],
                'image' => $image,
            ];
        }

        $name = $order->username;
        $order_link = '<a href="' . config('app.url') . '/profile/orders">訂購記録</a>';
        $class_link = '<a href="' . config('app.url') . '/profile">我的課程</a>';
        $discount_link = '<a href="' . config('app.url') . '/profile/coupons/avaliable">我的折扣</a>';

        $mail = $mail_notify->content;

        $mail = str_replace(
            ["{name}", "{order_link}", "{class_link}", "{discount_link}", "\n"],
            [$name, $order_link, $class_link, $discount_link, "<br>"],
            $mail
        );

        $data = [
            'items' => $items,
            'mail' => $mail,
            'order' => $order,
            'email' => $order->email,
            'discount' => $order->discount,
            'subject' => $mail_notify->subject,
        ];

        Mail::send('frontend.email.order_notify', $data, function ($message) use ($data) {
            $message->to($data['email'])->subject($data['subject']);
        });
    }

    /**
     * Email 驗證
     */
    public function email_verify(int $member_id = 0)
    {

        // 驗證 MailNotify 取得內容
        $mailNotify = MailNotify::find(1);

        $member = Member::find($member_id);
        $content = $mailNotify->content;
        $website =  config('app.url') . '/verify_email?email=' . urlencode($member->email) . '&code=' . $member->verify_email;
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
