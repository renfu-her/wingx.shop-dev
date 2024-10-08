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
use App\Http\Controllers\MapController;
use App\Http\Controllers\SessionController;

use App\Http\Controllers\Api\ImportDataController;

use App\Http\Controllers\Test\TestController;

use Illuminate\Auth\Events\Login;

route::get('/', [IndexController::class, 'index'])->name('home.index');
route::get('/category/{category_id}', [CategoryController::class, 'index'])->name('category.index');

route::post('/price/get', [ProductIndexController::class, 'priceGet'])->name('product.priceGet');

route::group(
    [
        'controller' => ProductIndexController::class,
        'prefix' => 'product',
        'as' => 'product.'
    ],
    function () {
        route::get('/{product_id}', 'index')->name('indexId');
        route::post('/spec', 'spec')->name('spec');
        route::post('/spec/list', 'specList')->name('spec.list');
    }
);

// 購物車寫入 session cart
route::group(
    [
        'controller' => CartController::class,
        'prefix' => 'cart',
        'as' => 'cart.'
    ],
    function () {
        route::get('/', 'index')->name('index');
        route::post('/thanks', 'thanks');
        route::post('/order', 'order');
        route::post('/delete', 'cartDelete');
        route::post('/count', [OrderController::class, 'cartCount']);
        route::group(['controller' => MapController::class], function () {
            route::get('/map', 'index')->name('map');
            route::post('/rewrite', 'rewrite')->name('map.rewrite');
        });
        route::post('/server/reply', 'serverReply');
        route::post('/client/reply', 'clientReply');
    }
);

route::group(
    [
        'controller' => OrderController::class,
        'prefix' => 'order',
        'as' => 'order.'
    ],
    function () {
        route::get('/list', 'list')->name('list');
        route::post('/store', 'store')->name('data.store');
        route::get('/status/{logisticsId}', 'orderStatus')->name('data.status');
        route::get('/cancel/{logisticsId}', 'cancelOrder')->name('cancelOrder');
        route::get('/checkCarrierNum',  'checkCarrierNum')->name('checkCarrierNum');
    }
);

// // 會員個人資料
route::group(
    [
        'controller' => ProfileController::class,
        'prefix' => 'profile',
        'as' => 'profile.'
    ],
    function () {
        route::get('/', 'index')->name('index');
        route::put('/update/{member_id}', 'update')->name('update');
    }
);

route::get('/importData/{product_id}', [ImportDataController::class, 'index']);
route::get('/importStoreData', [ImportDataController::class, 'storeData']);
route::get('/importDetailData', [ImportDataController::class, 'storeDetailData']);

route::get('/contact-us', [ContactController::class, 'index']);

// 購物車詳細資料
route::get('/checkout', [CartController::class, 'checkout']);
route::post('/store-session-id', [SessionController::class, 'store'])->name('storeSessionId');

// Q&A 列表
route::get('/qa', [QAController::class, 'index'])->name('qaIndex');

// 登入
route::group(
    [
        'controller' => LoginController::class
    ],
    function () {
        route::get('login', 'index')->name('get.login');
        route::post('login', 'login')->name('post.login');
        route::post('/sign-up', 'signUp')->name('post.signUp');
        route::post('/forgot-password', 'forgot_password')->name('post.forgotPassword');
        route::post('/check_email', 'check_email')->name('post.checkEmail');
        route::post('/reset_password', 'reset_password')->name('post.resetPassword');
        route::get('/reset_password', 'reset_verify_password')->name('get.resetVerifyPassword');
        route::post('/verify_password', 'verify_password')->name('post.verifyPassword');
        route::get('/verify_email', 'verify_email')->name('post.verifyEmail');
        route::post('/email_verify', 'email_verify')->name('post.emailVerify');

        // LINE 合併 Email
        route::get('/line-combine', 'lineCombine');
    }
);

route::get('/privacy', [PolicyController::class, 'privacy_policy']);

// route::get('/captcha', function () {
//     return Captcha::create();
// });

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
route::group([
    'controller' => TestController::class,
    'prefix' => 'test',
    'as' => 'test.'
], function () {
    route::get('/order',  'orderStatus')->name('orderStatus');
    route::get('/queryOrderStatus',  'queryOrderStatus')->name('queryOrderStatus');
    route::get('/eInvoice/{order_no}',  'eInvoice')->name('eInvoice');
    route::get('/shipToProductShip',  'shipToProductShip')->name('shipToProductShip');
    route::get('/getLogisticsStatus',  'getLogisticsStatus')->name('getLogisticsStatus');
    // route::get('/checkCarrierNum',  'checkCarrierNum')->name('checkCarrierNum');
});
