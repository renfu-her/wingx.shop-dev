<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductIndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Api\ImportDataController;
use Illuminate\Auth\Events\Login;

route::get('/', [IndexController::class, 'index']);
route::get('/category/{category_id}', [CategoryController::class, 'index']);
route::get('/product/{product_id}', [ProductIndexController::class, 'index']);

route::get('/importData/{product_id}', [ImportDataController::class, 'index']);
route::get('/importStoreData', [ImportDataController::class, 'storeData']);
route::get('/importDetailData', [ImportDataController::class, 'storeDetailData']);

route::get('/cart', [CartController::class, 'index']);
route::post('/cart/order', [CartController::class, 'order']);


route::get('login', [LoginController::class, 'index']);
route::post('login', [LoginController::class, 'login']);

route::get('/logout', function(){
    auth()->logout();
    session()->forget('cart');
    return redirect('/');
});

