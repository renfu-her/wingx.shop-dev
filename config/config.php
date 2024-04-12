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
    'INVOICE_ID_DEV' => '20000132',
    'INVOICE_HASH_KEY_DEV' => 'ejCk326UnaZWKisg',
    'INVOCE_HASH_IV_DEV' => 'q9jcZX8Ib9LM8wYk',
    'INVOICE_ID' => '20000132',
    'INVOICE_HASH_KEY' => 'ECPAY_HASH_KEY',
    'INVOCE_HASH_IV' => 'ECPAY_HASH_IV',

    "EXPRESS_URL" => env("EXPRESS_URL", "https://logistics-stage.ecpay.com.tw/Express/v2/"),
    "EXPRESS_MAP_URL" => env("EXPRESS_MAP_URL", "https://logistics-stage.ecpay.com.tw/Express/map"),
    "EXPRESS_MERCHANT_ID" => env("EXPRESS_MERCHANT_ID", "2000132"),
    "EXPRESS_HASH_KEY" => env("EXPRESS_HASH_KEY", "5294y06JbISpM5x9"),
    "EXPRESS_HASH_IV" => env("EXPRESS_HASH_IV", "v77hoKGq4kWxNNIS"),
    "EXPRESS_VISION" => env("EXPRESS_VISION", "1.0.0"),



];
