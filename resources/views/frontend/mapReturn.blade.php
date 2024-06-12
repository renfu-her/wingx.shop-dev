<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    SessionStorage.setItem('dataArrayJson', '{!! $dataArrayJson !!}');
    sessionStorage.setItem('sessionId', '{{ session()->getId() }}');
    const dataArrayJson = sessionStorage.getItem('dataArrayJson');
    const sessionId = sessionStorage.getItem('sessionId');
    console.log('dataArrayJson:', dataArrayJson);
    console.log('sessionId:', sessionId);
    
    $(document).ready(function() {
        function performOperationsAndReturn() {
            // 創建一個陣列
            const dataArray = {!! $dataArrayJson !!};
            window.opener.postMessage(dataArray, "{{ config('config.APP_URL') . '/checkout' }}");


            // 關閉當前標籤
            // window.close();
        }

        performOperationsAndReturn();
    });
</script>
