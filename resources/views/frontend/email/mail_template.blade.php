<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圈圈的聯絡我們</title>
</head>
<body>
    @include('frontend.email.mail_header')
    <table class="table-container">
        <thead>
            <tr>
                <td class="td-head">
                    <img src="{{ config('app.url') }}/frontend/images/circlewe-logo.png" alt="">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                </td>
            </tr>

        </tbody>
    </table>
    </table>

</body>
<style>
    .table-container {
        width: 100%;
    }
    .header {
        text-align: center;

    }
    .td-head {
        text-align: center
    }
</style>
</html>
