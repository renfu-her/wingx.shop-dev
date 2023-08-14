<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ShipController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductOrderController;
use App\Http\Controllers\Api\PolicyAdminController;
use App\Http\Controllers\Api\AuthApiController;

route::post('/ship/price', [ShipController::class, 'getPrice']);
route::get('/product/order', [ProductOrderController::class, 'index']);
route::get('/product/order/image/{id}', [ProductOrderController::class, 'productImage']);
route::get('/get_policy/{policy_id}', [PolicyAdminController::class, 'getPolicy']);



// 登入路由
route::post('/login', [AuthApiController::class, 'login'])->name('api.login');
// route::post('/login', function(){
//     dd('test');
// });

// 需要 token 認證的路由
route::middleware('auth:sanctum')->group(function () {
    // 其他需要認證的 API 路由
    route::get('/user', [AuthApiController::class, 'user'])->name('api.user');
    route::post('logout', [AuthApiController::class, 'logout'])->name('api.logout');
});
