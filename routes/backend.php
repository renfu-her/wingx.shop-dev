<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NewsAdminController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\BannerController;

route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
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

    // Banner 管理
    route::resource('/banner', BannerController::class);

});

route::get('/backend/login', [AuthController::class, 'login'])->name('backend_login');
route::post('/backend/login_verify', [AuthController::class, 'login_verify'])->name('login_verify');
route::get('/backend/logout', [AuthController::class, 'logout']);

