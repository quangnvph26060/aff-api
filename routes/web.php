<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CategoryController;
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



Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');
Route::get('demo', [AuthController::class, 'getUser']);

Route::post('admin/login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth.user'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
    // Product routes
    Route::get('product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/add', function () {
        return view('admin.products.add');
    })->name('product.add');
    Route::get('product/list', function () {
        return view('admin.products.listproduct');
    })->name('product.list');
    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    // add category
    Route::post('/add-category', [CategoryController::class, 'store'])->name('category.store');
    // screen add category
    Route::get('category/add', function () {
        return view('admin.category.addcategory');
    })->name('category.add');
    Route::get('category/list', function () {
        return view('admin.category.listcategory');
    })->name('category.list');
    // Order routes
    Route::get('order/list', function () {
        return view('admin.order.list');
    })->name('order.list');
    // user
    Route::get('user-info',function(){
        return view('admin.user.index');
    })->name('user-info');
});
