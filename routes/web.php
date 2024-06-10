<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\checklogin;
use Predis\Configuration\Option\Prefix;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return view('admin.login');
});


Route::prefix('login')->group(function(){
    Route::post('dangnhap/{type}', [AuthController::class, 'login'])->name('logindangnhap');
});

Route::prefix('product')->group(function(){
    Route::get('', [ProductController::class, 'store'])->name('product.store');
});


