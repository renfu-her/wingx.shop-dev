<?php

$mode = env('ECPAY_MODE', env('APP_ENV', 'local') === 'local' ? 'test' : 'production');
$isProduction = $mode === 'production';

return [
    'mode' => $mode,
    'express_url' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_SERVICE_URL', 'https://logistics.ecpay.com.tw/Express/v2/')
        : env('ECPAY_LOGISTICS_TEST_SERVICE_URL', 'https://logistics-stage.ecpay.com.tw/Express/v2/'),
    'create_url' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_CREATE_URL', 'https://logistics.ecpay.com.tw/Express/Create')
        : env('ECPAY_LOGISTICS_TEST_CREATE_URL', 'https://logistics-stage.ecpay.com.tw/Express/Create'),
    'query_url' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_QUERY_URL', 'https://logistics.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4')
        : env('ECPAY_LOGISTICS_TEST_QUERY_URL', 'https://logistics-stage.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4'),
    'map_url' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_MAP_URL', 'https://logistics.ecpay.com.tw/Express/map')
        : env('ECPAY_LOGISTICS_TEST_MAP_URL', 'https://logistics-stage.ecpay.com.tw/Express/map'),
    'merchant_id' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_MERCHANT_ID', '3383763')
        : env('ECPAY_LOGISTICS_TEST_MERCHANT_ID', '2000933'),
    'hash_key' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp')
        : env('ECPAY_LOGISTICS_TEST_HASH_KEY', 'XBERn1YOvpM9nfZc'),
    'hash_iv' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_HASH_IV', 'HJz5BtcreByPP2Z5')
        : env('ECPAY_LOGISTICS_TEST_HASH_IV', 'h1ONHk4P4yqbl5LK'),
    'vision' => $isProduction
        ? env('ECPAY_LOGISTICS_PROD_VISION', '1.0.0')
        : env('ECPAY_LOGISTICS_TEST_VISION', '1.0.0'),
];
