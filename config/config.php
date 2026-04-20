<?php

$mode = env('ECPAY_MODE', env('APP_ENV', 'local') === 'local' ? 'test' : 'production');
$isProduction = $mode === 'production';

$paymentTest = [
    'merchant_id' => env('ECPAY_TEST_MERCHANT_ID', '3002599'),
    'hash_key' => env('ECPAY_TEST_HASH_KEY', 'spPjZn66i0OhqJsQ'),
    'hash_iv' => env('ECPAY_TEST_HASH_IV', 'hT5OJckN45isQTTs'),
    'checkout_url' => env('ECPAY_TEST_CHECKOUT_URL', 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5'),
    'query_trade_info_url' => env('ECPAY_TEST_QUERY_TRADE_INFO_URL', 'https://payment-stage.ecpay.com.tw/Cashier/QueryTradeInfo/V5'),
];

$paymentProduction = [
    'merchant_id' => env('ECPAY_PROD_MERCHANT_ID', '3383763'),
    'hash_key' => env('ECPAY_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
    'hash_iv' => env('ECPAY_PROD_HASH_IV', 'HJz5BtcreByPP2Z'),
    'checkout_url' => env('ECPAY_PROD_CHECKOUT_URL', 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5'),
    'query_trade_info_url' => env('ECPAY_PROD_QUERY_TRADE_INFO_URL', 'https://payment.ecpay.com.tw/Cashier/QueryTradeInfo/V5'),
];

$invoiceTest = [
    'merchant_id' => env('ECPAY_INVOICE_TEST_MERCHANT_ID', '2000132'),
    'hash_key' => env('ECPAY_INVOICE_TEST_HASH_KEY', 'ejCk326UnaZWKisg'),
    'hash_iv' => env('ECPAY_INVOICE_TEST_HASH_IV', 'q9jcZX8Ib9LM8wYk'),
    'issue_url' => env('ECPAY_INVOICE_TEST_ISSUE_URL', 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue'),
    'b2b_issue_url' => env('ECPAY_INVOICE_TEST_B2B_ISSUE_URL', 'https://einvoice-stage.ecpay.com.tw/B2BInvoice/Issue'),
    'check_barcode_url' => env('ECPAY_INVOICE_TEST_CHECK_BARCODE_URL', 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/CheckBarcode'),
];

$invoiceProduction = [
    'merchant_id' => env('ECPAY_INVOICE_PROD_MERCHANT_ID', '3383763'),
    'hash_key' => env('ECPAY_INVOICE_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
    'hash_iv' => env('ECPAY_INVOICE_PROD_HASH_IV', 'HJz5BtcreByPP2Z5'),
    'issue_url' => env('ECPAY_INVOICE_PROD_ISSUE_URL', 'https://einvoice.ecpay.com.tw/B2CInvoice/Issue'),
    'b2b_issue_url' => env('ECPAY_INVOICE_PROD_B2B_ISSUE_URL', 'https://einvoice.ecpay.com.tw/B2BInvoice/Issue'),
    'check_barcode_url' => env('ECPAY_INVOICE_PROD_CHECK_BARCODE_URL', 'https://einvoice.ecpay.com.tw/B2CInvoice/CheckBarcode'),
];

$logisticsTest = [
    'merchant_id' => env('ECPAY_LOGISTICS_TEST_MERCHANT_ID', '2000933'),
    'hash_key' => env('ECPAY_LOGISTICS_TEST_HASH_KEY', 'XBERn1YOvpM9nfZc'),
    'hash_iv' => env('ECPAY_LOGISTICS_TEST_HASH_IV', 'h1ONHk4P4yqbl5LK'),
    'create_url' => env('ECPAY_LOGISTICS_TEST_CREATE_URL', 'https://logistics-stage.ecpay.com.tw/Express/Create'),
    'query_url' => env('ECPAY_LOGISTICS_TEST_QUERY_URL', 'https://logistics-stage.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4'),
    'map_url' => env('ECPAY_LOGISTICS_TEST_MAP_URL', 'https://logistics-stage.ecpay.com.tw/Express/map'),
    'service_url' => env('ECPAY_LOGISTICS_TEST_SERVICE_URL', 'https://logistics-stage.ecpay.com.tw/Express/v2/'),
    'vision' => env('ECPAY_LOGISTICS_TEST_VISION', '1.0.0'),
];

$logisticsProduction = [
    'merchant_id' => env('ECPAY_LOGISTICS_PROD_MERCHANT_ID', '3383763'),
    'hash_key' => env('ECPAY_LOGISTICS_PROD_HASH_KEY', 'jIS2talQzOhj9Hmp'),
    'hash_iv' => env('ECPAY_LOGISTICS_PROD_HASH_IV', 'HJz5BtcreByPP2Z5'),
    'create_url' => env('ECPAY_LOGISTICS_PROD_CREATE_URL', 'https://logistics.ecpay.com.tw/Express/Create'),
    'query_url' => env('ECPAY_LOGISTICS_PROD_QUERY_URL', 'https://logistics.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4'),
    'map_url' => env('ECPAY_LOGISTICS_PROD_MAP_URL', 'https://logistics.ecpay.com.tw/Express/map'),
    'service_url' => env('ECPAY_LOGISTICS_PROD_SERVICE_URL', 'https://logistics.ecpay.com.tw/Express/v2/'),
    'vision' => env('ECPAY_LOGISTICS_PROD_VISION', '1.0.0'),
];

$payment = $isProduction ? $paymentProduction : $paymentTest;
$invoice = $isProduction ? $invoiceProduction : $invoiceTest;
$logistics = $isProduction ? $logisticsProduction : $logisticsTest;

return [
    'APP_ENV' => env('APP_ENV'),
    'APP_URL' => env('APP_URL'),
    'ECPAY_MODE' => $mode,

    'ECPAY_MERCHANT_ID_DEV' => $paymentTest['merchant_id'],
    'ECPAY_HASH_KEY_DEV' => $paymentTest['hash_key'],
    'ECPAY_HASH_IV_DEV' => $paymentTest['hash_iv'],
    'ECPAY_MERCHANT_ID' => $paymentProduction['merchant_id'],
    'ECPAY_HASH_KEY' => $paymentProduction['hash_key'],
    'ECPAY_HASH_IV' => $paymentProduction['hash_iv'],
    'ECPAY_QUERY_TRADE_INFO_DEV' => $paymentTest['query_trade_info_url'],
    'ECPAY_QUERY_TRADE_INFO' => $paymentProduction['query_trade_info_url'],

    'INVOICE_ID_DEV' => $invoiceTest['merchant_id'],
    'INVOICE_HASH_KEY_DEV' => $invoiceTest['hash_key'],
    'INVOCE_HASH_IV_DEV' => $invoiceTest['hash_iv'],
    'INVOICE_ID' => $invoiceProduction['merchant_id'],
    'INVOICE_HASH_KEY' => $invoiceProduction['hash_key'],
    'INVOCE_HASH_IV' => $invoiceProduction['hash_iv'],
    'INVOICE_ISSUE_URL_DEV' => $invoiceTest['issue_url'],
    'INVOICE_ISSUE_URL' => $invoiceProduction['issue_url'],
    'INVOICE_B2B_ISSUE_URL_DEV' => $invoiceTest['b2b_issue_url'],
    'INVOICE_B2B_ISSUE_URL' => $invoiceProduction['b2b_issue_url'],
    'INVOICE_CHECK_BARCODE_URL_DEV' => $invoiceTest['check_barcode_url'],
    'INVOICE_CHECK_BARCODE_URL' => $invoiceProduction['check_barcode_url'],

    'EXPRESS_URL' => $logistics['service_url'],
    'EXPRESS_MAP_URL' => $logistics['map_url'],
    'EXPRESS_MERCHANT_ID' => $logisticsProduction['merchant_id'],
    'EXPRESS_HASH_KEY' => $logisticsProduction['hash_key'],
    'EXPRESS_HASH_IV' => $logisticsProduction['hash_iv'],
    'EXPRESS_VISION' => $logisticsProduction['vision'],
    'EXPRESS_MERCHANT_ID_DEV' => $logisticsTest['merchant_id'],
    'EXPRESS_HASH_KEY_DEV' => $logisticsTest['hash_key'],
    'EXPRESS_HASH_IV_DEV' => $logisticsTest['hash_iv'],
    'EXPRESS_VISION_DEV' => $logisticsTest['vision'],
    'EXPRESS_CREATE_DEV' => $logisticsTest['create_url'],
    'EXPRESS_CREATE' => $logisticsProduction['create_url'],
    'EXPRESS_LOGISTICS_DEV' => $logisticsTest['query_url'],
    'EXPRESS_LOGISTICS' => $logisticsProduction['query_url'],
];
