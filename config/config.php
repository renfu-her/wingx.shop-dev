<?php

return [
    "APP_ENV" => env('APP_ENV'),
    "APP_URL" => env('APP_URL'),
    "ECPAY_MERCHANT_ID_DEV" => "3002599",
    "ECPAY_HASH_KEY_DEV" => "spPjZn66i0OhqJsQ",
    "ECPAY_HASH_IV_DEV" => "hT5OJckN45isQTTs",
    "ECPAY_MERCHANT_ID" => env('ECPAY_MERCHANT_ID'),
    "ECPAY_HASH_KEY" => env('ECPAY_HASH_KEY'),
    "ECPAY_HASH_IV" => env('ECPAY_HASH_IV'),

    // invoice config
    // 'INVOICE_ID_DEV' => '2000933',
    // 'INVOICE_HASH_KEY_DEV' => 'XBERn1YOvpM9nfZc',
    // 'INVOCE_HASH_IV_DEV' => 'h1ONHk4P4yqbl5LK',
    'INVOICE_ID_DEV' => '2000132',
    'INVOICE_HASH_KEY_DEV' => 'ejCk326UnaZWKisg',
    'INVOCE_HASH_IV_DEV' => 'q9jcZX8Ib9LM8wYk',
    'INVOICE_ID' => env('INVOICE_ID'),
    'INVOICE_HASH_KEY' => env('ECPAY_HASH_KEY'),
    'INVOCE_HASH_IV' => env('ECPAY_HASH_IV'),

    "EXPRESS_URL" => env("EXPRESS_URL", "https://logistics-stage.ecpay.com.tw/Express/v2/"),
    "EXPRESS_MAP_URL" => env("EXPRESS_MAP_URL", "https://logistics-stage.ecpay.com.tw/Express/map"),
    "EXPRESS_MERCHANT_ID" => env("EXPRESS_MERCHANT_ID", "3383763"),
    "EXPRESS_HASH_KEY" => env("EXPRESS_HASH_KEY", "jIS2talQzOhj9Hmp"),
    "EXPRESS_HASH_IV" => env("EXPRESS_HASH_IV", "HJz5BtcreByPP2Z5"),
    "EXPRESS_VISION" => env("EXPRESS_VISION", "1.0.0"),
    "EXPRESS_MERCHANT_ID_DEV" => env("EXPRESS_MERCHANT_ID_DEV", "2000933"),
    "EXPRESS_HASH_KEY_DEV" => env("EXPRESS_HASH_KEY_DEV", "XBERn1YOvpM9nfZc"),
    "EXPRESS_HASH_IV_DEV" => env("EXPRESS_HASH_IV_DEV", "h1ONHk4P4yqbl5LK"),
    "EXPRESS_VISION_DEV" => env("EXPRESS_VISION_DEV", "1.0.0"),

    // 物流查詢
    "EXPRESS_LOGISTICS_DEV" => 'https://logistics-stage.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4',
    "EXPRESS_LOGISTICS" => 'https://logistics.ecpay.com.tw/Helper/QueryLogisticsTradeInfo/V4',

];
