<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        function performOperationsAndReturn() {
            // 創建一個陣列
            var dataArray = {!! $dataArrayJson !!};
            
            // 將陣列轉換為 JSON 字符串並存儲
            sessionStorage.setItem('returnedData', JSON.stringify(dataArray));

            // 關閉當前標籤
            // window.close();
        }

        performOperationsAndReturn();
    });
</script>
