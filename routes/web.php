<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductIndexController;

use App\Http\Controllers\Api\ImportDataController;

route::get('/', [IndexController::class, 'index']);
route::get('/category/{category_id}', [CategoryController::class, 'index']);
route::get('/product/{product_id}', [ProductIndexController::class, 'index']);

route::get('/importData/{product_id}', [ImportDataController::class, 'index']);
route::get('/importStoreData', [ImportDataController::class, 'storeData']);

