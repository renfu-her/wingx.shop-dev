<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\MailNotify;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;

use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use DB;
use Log;

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
            ["<br>", $member->name, $website],
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

    // 寄送 Order 通知信
    public function order_notify(int $order_id = 0)
    {
        // 驗證 MailNotify 取得內容
        $mailNotify = MailNotify::find(3);

        $order = Order::find($order_id);
        $member = Member::find($order->member_id);
        $content = $mailNotify->content;

        $orderDetail = OrderDetail::where('order_id', $order->id)->get();
        $orderDetails = [];
        foreach ($orderDetail as $key => $value) {
            $data = [
                'product_name' => $value->name,
                'qty' => $value->qty,
                'price' => $value->price,
                'subTotal' => $value->sub_total,
            ];

            array_push($data, $orderDetails);
        }

        $website =  config('app.url') . '/order/' . $order->order_no;
        $content = str_replace(
            ["\n", '{name}', '{website}', '{order_no}', '{order_date}', '{order_total}', '{orderDetails}'],
            ["<br>", $member->name, $website, $order->order_no, $order->created_at, $order->total, $orderDetails],
            $content
        );

        $data = [
            'email' => trim($member->email),
            'content' => $content,
            'subject' => $mailNotify->subject,
        ];

        Mail::send('frontend.email.order_notify', $data, function ($message) use ($data) {
            $message->to($data['email'])->bcc($this->bcc_list)
                ->subject($data['subject']);
        });
    }
}
