<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductIndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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
route::get('/orderList', [CartController::class, 'orderList']);

route::post('/cart/count', [OrderController::class, 'cartCount']);

// 登入
route::get('login', [LoginController::class, 'index']);
route::post('login', [LoginController::class, 'login']);
Route::post('/sign-up', [LoginController::class, 'signUp']);
Route::post('/forgot-password', [LoginController::class, 'forgot_password']);
Route::post('/check_email', [LoginController::class, 'check_email']);
Route::post('/reset_password', [LoginController::class, 'reset_password']);
Route::get('/reset_password', [LoginController::class, 'reset_verify_password']);
Route::post('/verify_password', [LoginController::class, 'verify_password']);
Route::get('/verify_email', [LoginController::class, 'verify_email']);
route::get('/captcha', function () {
    return Captcha::create();
});

route::get('/logout', function(){
    auth()->logout();
    session()->forget(['cart', 'member_id', 'member_name', 'member_email']);
    return redirect('/');
});

