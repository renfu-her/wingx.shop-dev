<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ShipController;
use App\Http\Controllers\Api\OrderApiController;

route::post('/ship/price', [ShipController::class, 'getPrice']);
