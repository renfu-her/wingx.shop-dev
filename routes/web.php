<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Api\ImportDataController;


Route::get('/', [IndexController::class, 'index']);

Route::get('/importData/{product_id}', [ImportDataController::class, 'index']);
Route::get('/importStoreData', [ImportDataController::class, 'storeData']);

