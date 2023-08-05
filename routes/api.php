<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ShipController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductOrderController;

route::post('/ship/price', [ShipController::class, 'getPrice']);
route::get('/product/order', [ProductOrderController::class, 'index']);
route::get('/product/order/image/{id}', [ProductOrderController::class, 'productImage']);
