<table align="center"
    style="width: 100%; background: #EAF0F6;
border-collapse:collapse; border:0; text-align: center; border: 0; "
    cellpadding="0" border="0">
    <tbody>
        <tr style="border: 0;" cellpadding="0">
            <td style="border: 0;" cellpadding="0" align="center" valign="center">
                <table
                    style="width: max-width: 600px; width: 600px; background-color: #ffffff; border-collapse:collapse; border: 0;"
                    border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr style="border: 0;">
                            <td style="border: 0;">
                                @include('frontend.email.mail_header')

                                <table style="width: 100%; background-color: #ffffff" border="0">
                                    <tbody>
                                        <tr style="width: 600px;">
                                            <td
                                            style="color:black;
                                            font-weight: 600; font-size: 20px; padding: 20px">
                                                訂單完成
                                            </td>
                                        </tr>
                                        <tr style="width: 600px;">
                                            <td style="padding: 20px">
                                                {!! $mail !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table style="width: 100%; background-color: #ffffff" border="0">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="font-size: 20px; font-weight: bold; padding-left: 20px; padding-bottom: 10px">
                                                訂購內容
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">
                                                <table
                                                    style="width: 550px; margin-left: auto; margin-right: auto; background-color: #F8F5F2"
                                                    border="0">

                                                    @foreach ($items as $key => $value)
                                                        <tr>
                                                            <td style="width: 30%; padding: 10px">
                                                                <img src="{{ $value['image'] }}"
                                                                    style="width: 150px;">
                                                            </td>
                                                            <td style="width: 40%; padding: 10px; text-align: left !important">
                                                                {!! $value['title'] !!}
                                                            </td>
                                                            <td style="width: 30%; text-align: right; padding: 10px">
                                                                NT$ {{ $value['amount'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3" style="text-align: right; padding: 10px">
                                                            <span >折扣：NT ${{ $order->discount ?? 0 }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="3" style="text-align: right; padding: 10px">
                                                            <span style="color: rgb(240, 108, 0);">實付金額：NT$
                                                                {{ $order->amount }}</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr style="background-color: #ffffff">
                            <td style="padding-top: 30px; padding-bottom: 30px; text-align: center">
                                <a href="{{ config('app.url') }}/profile/orders"
                                    style="
                            background-color: #58C3E0;
                            color: white;
                            padding: 15px 100px;
                            text-decoration: none;
                            cursor: pointer;
                            border-radius: 12px;">查看訂單內容</a>
                            </td>
                        </tr>

                        @include('frontend.email.mail_footer')

                    </tbody>
                </table>
                <div style="padding-bottom: 20px"></div>
            </td>
        </tr>
    </tbody>
</table>
<div style="margin-bottom: 20px">&nbsp;</div>
</td>
</tr>
</tbody>
</table>
