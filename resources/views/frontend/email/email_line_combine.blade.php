<table align="center"
    style="width: 100%; background: #EAF0F6;
border-collapse:collapse; border:0; text-align: center; border: 0; "
    cellpadding="0" border="0">
    <tbody>
        <tr style="border: 0;" cellpadding="0">
            <td style="border: 0;" cellpadding="0" align="center" valign="center">
                <table
                    style="width: max-width: 600px; width: 600px; background-color: #ffffff; border-collapse:collapse; border: 0;"
                    border="0" cellpadding="0">
                    <tbody>
                        <tr style="border: 0;">
                            <td style="border: 0;">
                                @include('frontend.email.mail_header')

                                <table style="width: 100%; background-color: #ffffff" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr style="width: 600px;">
                                            <td
                                            style="color:black;
                                            font-weight: 600; font-size: 20px; padding: 20px">
                                                想要合併的 Email 帳號：{{ $email }}
                                            </td>
                                        </tr>
                                        <tr style="width: 600px;">
                                            <td style="padding: 20px">
                                                {!! $content !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
