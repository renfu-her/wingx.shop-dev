<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;


Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
    Route::get('/', [AdminController::class, 'index']);
    route::resource('/product', ProductController::class);
});

Route::get('/backend/login', [AuthController::class, 'login'])->name('backend_login');
Route::post('/backend/login_verify', [AuthController::class, 'login_verify'])->name('login_verify');
Route::get('/backend/logout', [AuthController::class, 'logout']);

