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


Route::get('/admin/product', function () {
    return view('admin.products.product');
});
Route::get('/admin/product/add', function () {
    return view('admin.products.add');
});
Route::get('/admin/product/list', function () {
    return view('admin.listproduct');
});

Route::get('/admin/category', function () {
    return view('admin..category.category');
});
Route::get('/admin/category/add', function () {
    return view('admin.category.addcategory');
});
Route::get('/admin/category/list', function () {
    return view('admin.listcategory');
});
Route::get('/admin/order/list', function () {
    return view('admin.order.list');
});
