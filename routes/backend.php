<?php

use Illuminate\Support\Facades\route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;


route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
    route::get('/', [AdminController::class, 'index']);
    route::resource('/product', ProductController::class);
    route::get('/product/delete/{product_id}', [ProductController::class, 'delete']);
});

route::get('/backend/login', [AuthController::class, 'login'])->name('backend_login');
route::post('/backend/login_verify', [AuthController::class, 'login_verify'])->name('login_verify');
route::get('/backend/logout', [AuthController::class, 'logout']);

