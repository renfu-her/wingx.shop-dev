<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NewsAdminController;


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

});

route::get('/backend/login', [AuthController::class, 'login'])->name('backend_login');
route::post('/backend/login_verify', [AuthController::class, 'login_verify'])->name('login_verify');
route::get('/backend/logout', [AuthController::class, 'logout']);

