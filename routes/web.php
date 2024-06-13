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
    Route::post('ChangePassword', [AuthController::class, 'ChangePassword'])->name('ChangePassword');
    // Product routes
    Route::get('product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/add', [ProductController::class, 'addForm'])->name('product.add');
    Route::post('product/add', [ProductController::class, 'addSubmit'])->name('product.add.submit');
    Route::get('product/{id}', [ProductController::class, 'editForm'])->name('product.edit');
    Route::post('product/{id}', [ProductController::class, 'editSubmit'])->name('product.edit.submit');
    Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('product-search-name', [ProductController::class, 'search'])->name('product.search');
    Route::get('product-filter/{id}', [ProductController::class, 'productFilter'])->name('product.filter');
    // Route::get('product/list', function () {
    //     return view('admin.products.listproduct');
    // })->name('product.list');

    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/add', function () {
        return view('admin.category.addcategory');
    })->name('category.add');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Order routes
    Route::get('order/list', function () {
        return view('admin.order.list');
    })->name('order.list');
    // user
    Route::get('user-info',function(){
        return view('admin.user.index');
    })->name('user-info');
});
