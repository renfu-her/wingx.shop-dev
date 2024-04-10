<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductIndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\InvoiceLotteryController;

use App\Http\Controllers\Api\ImportDataController;

use App\Http\Controllers\Test\TestController;

use Illuminate\Auth\Events\Login;

route::get('/', [IndexController::class, 'index']);
route::get('/category/{category_id}', [CategoryController::class, 'index'])->name('category.index');

route::post('/price/get', [ProductIndexController::class, 'priceGet'])->name('product.priceGet');

route::group(['prefix' => 'product', 'name' => 'product.'], function () {
    route::get('/{product_id}', [ProductIndexController::class, 'index'])->name('product.indexId');
    route::post('/spec', [ProductIndexController::class, 'spec'])->name('product.spec');
    route::post('/spec/list', [ProductIndexController::class, 'specList'])->name('product.spec.list');
});

// 購物車寫入 session cart
route::group(['prefix' => 'cart', 'name' => 'cart.'], function () {
    route::get('/', [CartController::class, 'index']);
    route::post('/thanks', [CartController::class, 'thanks']);
    route::post('/order', [CartController::class, 'order']);
    route::post('/delete', [CartController::class, 'cartDelete']);
    route::post('/count', [OrderController::class, 'cartCount']);
});

route::group(['prefix' => 'order', 'name' => 'order.'], function () {
    route::get('/list', [OrderController::class, 'list']);
    route::post('/store', [OrderController::class, 'store']);
});

// 會員個人資料
route::group(['prefix' => 'profile', 'name' => 'profile.'], function () {
    route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    route::put('/update/{member_id}', [ProfileController::class, 'update'])->name('profile.update');
    
});

route::get('/importData/{product_id}', [ImportDataController::class, 'index']);
route::get('/importStoreData', [ImportDataController::class, 'storeData']);
route::get('/importDetailData', [ImportDataController::class, 'storeDetailData']);

route::get('/contact-us', [ContactController::class, 'index']);

// 購物車詳細資料
route::get('/checkout', [CartController::class, 'checkout']);

// Q&A 列表
route::get('/qa', [QAController::class, 'index']);

// 登入
route::get('login', [LoginController::class, 'index']);
route::post('login', [LoginController::class, 'login']);
route::post('/sign-up', [LoginController::class, 'signUp']);
route::post('/forgot-password', [LoginController::class, 'forgot_password']);
route::post('/check_email', [LoginController::class, 'check_email']);
route::post('/reset_password', [LoginController::class, 'reset_password']);
route::get('/reset_password', [LoginController::class, 'reset_verify_password']);
route::post('/verify_password', [LoginController::class, 'verify_password']);
route::get('/verify_email', [LoginController::class, 'verify_email']);
route::post('/email_verify', [LoginController::class, 'email_verify']);

// LINE 合併 Email
route::get('/line-combine', [LoginController::class, 'lineCombine']);

route::get('/privacy', [PolicyController::class, 'privacy_policy']);

route::get('/captcha', function () {
    return Captcha::create();
});

route::get('/logout', function () {
    auth()->logout();
    session()->forget(['cart', 'member_id', 'member_name', 'member_email']);
    return redirect('/');
});

// facebook 登入
Route::get('/auth/facebook', [FacebookController::class, 'fbLogin'])->name('/auth/facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'fbLoginCallback'])->name('/auth/facebook/callback');

Route::get('/auth/line', [LineController::class, 'lineLogin']);
Route::get('/auth/line/callback', [LineController::class, 'lineLoginCallback']);

route::get('/xmlToJson', [InvoiceLotteryController::class, 'readXmlToJson']);

// Test route
route::group(['prefix' => 'test'], function () {
    route::get('/order', [TestController::class, 'orderStatus']);
    route::get('/queryOrderStatus', [TestController::class, 'queryOrderStatus']);
    route::get('/eInvoice/{order_no}', [TestController::class, 'eInvoice']);
    route::get('/shipToProductShip', [TestController::class, 'shipToProductShip']);
});
