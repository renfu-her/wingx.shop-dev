<?php

$mode = env('ECPAY_MODE', env('APP_ENV', 'local') === 'local' ? 'test' : 'production');
$isProduction = $mode === 'production';
$callbackBaseUrl = rtrim(env('ECPAY_CALLBACK_BASE_URL', env('APP_URL', 'http://localhost')), '/');

$payment = $isProduction
    ? [
        'merchant_id' => env('ECPAY_PROD_MERCHANT_ID', '3383763'),
        'hash_key' => env('ECPAY_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
        'hash_iv' => env('ECPAY_PROD_HASH_IV', 'HJz5BtcreByPP2Z'),
        'checkout_url' => env('ECPAY_PROD_CHECKOUT_URL', 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5'),
        'query_trade_info_url' => env('ECPAY_PROD_QUERY_TRADE_INFO_URL', 'https://payment.ecpay.com.tw/Cashier/QueryTradeInfo/V5'),
    ]
    : [
        'merchant_id' => env('ECPAY_TEST_MERCHANT_ID', '3002599'),
        'hash_key' => env('ECPAY_TEST_HASH_KEY', 'spPjZn66i0OhqJsQ'),
        'hash_iv' => env('ECPAY_TEST_HASH_IV', 'hT5OJckN45isQTTs'),
        'checkout_url' => env('ECPAY_TEST_CHECKOUT_URL', 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5'),
        'query_trade_info_url' => env('ECPAY_TEST_QUERY_TRADE_INFO_URL', 'https://payment-stage.ecpay.com.tw/Cashier/QueryTradeInfo/V5'),
    ];

$logistics = $isProduction
    ? [
        'merchant_id' => env('ECPAY_LOGISTICS_PROD_MERCHANT_ID', '3383763'),
        'hash_key' => env('ECPAY_LOGISTICS_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
        'hash_iv' => env('ECPAY_LOGISTICS_PROD_HASH_IV', 'HJz5BtcreByPP2Z5'),
        'create_url' => env('ECPAY_LOGISTICS_PROD_CREATE_URL', 'https://logistics.ecpay.com.tw/Express/Create'),
        'query_url' => env('ECPAY_LOGISTICS_PROD_QUERY_URL', 'https://logistics.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4'),
        'map_url' => env('ECPAY_LOGISTICS_PROD_MAP_URL', 'https://logistics.ecpay.com.tw/Express/map'),
        'service_url' => env('ECPAY_LOGISTICS_PROD_SERVICE_URL', 'https://logistics.ecpay.com.tw/Express/v2/'),
        'vision' => env('ECPAY_LOGISTICS_PROD_VISION', '1.0.0'),
    ]
    : [
        'merchant_id' => env('ECPAY_LOGISTICS_TEST_MERCHANT_ID', '2000933'),
        'hash_key' => env('ECPAY_LOGISTICS_TEST_HASH_KEY', 'XBERn1YOvpM9nfZc'),
        'hash_iv' => env('ECPAY_LOGISTICS_TEST_HASH_IV', 'h1ONHk4P4yqbl5LK'),
        'create_url' => env('ECPAY_LOGISTICS_TEST_CREATE_URL', 'https://logistics-stage.ecpay.com.tw/Express/Create'),
        'query_url' => env('ECPAY_LOGISTICS_TEST_QUERY_URL', 'https://logistics-stage.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4'),
        'map_url' => env('ECPAY_LOGISTICS_TEST_MAP_URL', 'https://logistics-stage.ecpay.com.tw/Express/map'),
        'service_url' => env('ECPAY_LOGISTICS_TEST_SERVICE_URL', 'https://logistics-stage.ecpay.com.tw/Express/v2/'),
        'vision' => env('ECPAY_LOGISTICS_TEST_VISION', '1.0.0'),
    ];

$invoice = $isProduction
    ? [
        'merchant_id' => env('ECPAY_INVOICE_PROD_MERCHANT_ID', '3383763'),
        'hash_key' => env('ECPAY_INVOICE_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
        'hash_iv' => env('ECPAY_INVOICE_PROD_HASH_IV', 'HJz5BtcreByPP2Z5'),
        'issue_url' => env('ECPAY_INVOICE_PROD_ISSUE_URL', 'https://einvoice.ecpay.com.tw/B2CInvoice/Issue'),
        'b2b_issue_url' => env('ECPAY_INVOICE_PROD_B2B_ISSUE_URL', 'https://einvoice.ecpay.com.tw/B2BInvoice/Issue'),
        'check_barcode_url' => env('ECPAY_INVOICE_PROD_CHECK_BARCODE_URL', 'https://einvoice.ecpay.com.tw/B2CInvoice/CheckBarcode'),
    ]
    : [
        'merchant_id' => env('ECPAY_INVOICE_TEST_MERCHANT_ID', '2000132'),
        'hash_key' => env('ECPAY_INVOICE_TEST_HASH_KEY', 'ejCk326UnaZWKisg'),
        'hash_iv' => env('ECPAY_INVOICE_TEST_HASH_IV', 'q9jcZX8Ib9LM8wYk'),
        'issue_url' => env('ECPAY_INVOICE_TEST_ISSUE_URL', 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue'),
        'b2b_issue_url' => env('ECPAY_INVOICE_TEST_B2B_ISSUE_URL', 'https://einvoice-stage.ecpay.com.tw/B2BInvoice/Issue'),
        'check_barcode_url' => env('ECPAY_INVOICE_TEST_CHECK_BARCODE_URL', 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/CheckBarcode'),
    ];

return [
    'mode' => $mode,
    'callback_base_url' => $callbackBaseUrl,
    'payment' => $payment,
    'logistics' => $logistics,
    'invoice' => $invoice,

    // TsaiYiHua/laravel-ecpay package compatibility
    'MerchantId' => $payment['merchant_id'],
    'HashKey' => $payment['hash_key'],
    'HashIV' => $payment['hash_iv'],
    'InvoiceHashKey' => $invoice['hash_key'],
    'InvoiceHashIV' => $invoice['hash_iv'],
    'SendForm' => env('ECPAY_SEND_FORM', null),
];
