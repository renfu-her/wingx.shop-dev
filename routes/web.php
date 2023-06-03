<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Api\ImportDataController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/importData/{product_id}', [ImportDataController::class, 'index']);

