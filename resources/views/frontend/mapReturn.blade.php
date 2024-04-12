<script>
    $(document).ready(function() {
        function performOperationsAndReturn() {
            // 創建一個陣列
            var dataArray = {!! $dataArrayJson !!};

            // 將陣列轉換為 JSON 字符串並存儲
            localStorage.setItem('returnedData', JSON.stringify(dataArray));

            // 關閉當前標籤
            window.close();
        }

        performOperationsAndReturn();
    });
</script>
