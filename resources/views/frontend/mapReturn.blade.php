<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>付款中</title>
</head>

<body>
    <script>
        function performOperationsAndReturn() {
            // 創建一個陣列
            const dataArray = {!! $dataArrayJson !!};
            window.opener.postMessage(dataArray, "{{ config('config.APP_URL') . '/checkout' }}");

            // console.log('dataArray:', dataArray);

            // // 使用 AJAX 將 sessionId 傳遞到伺服器端
            // $.ajax({
            //     url: '{{ route('storeSessionId') }}', // 定義你的路由
            //     method: 'POST',
            //     data: {
            //         _token: '{{ csrf_token() }}', // CSRF 保護
            //         sessionId: '{{ $dataArray['sessionID'] }}'
            //     },
            //     success: function(response) {
            //         console.log('Session ID 已成功傳遞到伺服器端:', response);
            //     },
            //     error: function(error) {
            //         console.error('傳遞 Session ID 時出現錯誤:', error);
            //     }
            // });

            // 關閉當前標籤
            // window.close();
        }

        performOperationsAndReturn();
    </script>

</body>

</html>
