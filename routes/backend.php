<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NewsAdminController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ProductMixController;
use App\Http\Controllers\Backend\MailNotifyController;
use App\Http\Controllers\Backend\ShipController;
use App\Http\Controllers\Backend\OrderAdminController;
use App\Http\Controllers\Backend\QaAdminController;
use App\Http\Controllers\Backend\PolicyAdminController;
use App\Http\Controllers\Backend\ProductDetailController;

route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
    route::get('/', [AdminController::class, 'backendTo']);

    // 管理者管理
    route::resource('/admin', AdminController::class);
    route::get('/admin/delete/{user_id}', [AdminController::class, 'delete']);

    // 最新消息管理
    route::resource('/news', NewsAdminController::class);
    route::get('/news/delete/{news_id}', [NewsAdminController::class, 'delete']);

    // 產品管理
    route::resource('/product', ProductController::class);
    route::get('/product/delete/{product_id}', [ProductController::class, 'delete']);

    // 產品圖片管理
    route::get('/product/image/{product_id}', [ProductImageController::class, 'index'])->name('product_image.index');
    route::get('/product/image/{product_id}/create', [ProductImageController::class, 'create'])->name('product_image.create');
    route::post('/product/image/{product_id}', [ProductImageController::class, 'store'])->name('product_image.store');
    route::get('/product/image/{product_id}/{product_image_id}/edit', [ProductImageController::class, 'edit'])->name('product_image.edit');
    route::match(['PUT', 'PATCH'], '/product/image/{product_image_id}', [ProductImageController::class, 'update'])->name('product_image.update');
    route::get('/product/image/delete/{product_image_id}', [ProductImageController::class, 'delete'])->name('product_image.delete');

    // 產生產品組合
    route::get('/product/mix/{product_id}', [ProductMixController::class, 'index'])->name('product_mix.index');
    route::get('/product/mix/{product_id}/create', [ProductMixController::class, 'create'])->name('product_mix.create');
    route::post('/product/mix/{product_id}', [ProductMixController::class, 'store'])->name('product_mix.store');
    route::get('/product/mix/{product_id}/{product_mix_id}/edit', [ProductMixController::class, 'edit'])->name('product_mix.edit');
    route::match(['PUT', 'PATCH'], '/product/mix/{product_mix_id}', [ProductMixController::class, 'update'])->name('product_mix.update');
    route::get('/product/mix/delete/{product_mix_id}', [ProductMixController::class, 'delete'])->name('product_mix.delete');

    // q&a 管理
    route::resource('/qa', QaAdminController::class);

    route::resource('/ship', ShipController::class);
    route::get('/ship/delete/{ship_id}', [ShipController::class, 'delete']);

    // MailNotify 管理
    route::resource('/mail_notify', MailNotifyController::class);
    route::get('/mail_notify/delete/{mail_notify_id}', [MailNotifyController::class, 'delete']);

    // Banner 管理
    route::resource('/banner', BannerController::class);

    // 訂單管理
    route::resource('/order', OrderAdminController::class);

    route::get('/policies/delete/{id}', [PolicyAdminController::class, 'delete']);
    route::resource('/policies', PolicyAdminController::class);

    // 商品管理細項
    route::get('/product/{product_id}/detail', [ProductDetailController::class, "edit"])->name('product.detail.edit');
    route::post('/product/detail/save', [ProductDetailController::class, "store"])->name('product.detail.save');
});

route::get('/backend/login', [AuthController::class, 'login'])->name('backend_login');
route::post('/backend/login_verify', [AuthController::class, 'login_verify'])->name('login_verify');
route::get('/backend/logout', [AuthController::class, 'logout']);
