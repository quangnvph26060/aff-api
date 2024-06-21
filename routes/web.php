<?php

use App\Events\NewOrderEvent;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\TransactionController;
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
// demo

Route::get('/event',function(){
    event(new NewOrderEvent('demo noti message'));
});
Route::get('ad',function(){
    return view('emails.order');
});
Route::fallback(function () {
    return view('errors.404');
});
// end demo

Route::get('/', [AuthController::class,'viewLogin'])->name('admin.login');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AuthController::class,'viewLogin'])->name('admin.login');
    Route::get('/', [AuthController::class,'viewLogin'])->name('admin.login');
});
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
    Route::get('product-images/{id}', [ProductController::class, 'deleteImagesProduct'])->name('deleteImagesProduct');
    Route::post('product-category', [ProductController::class, 'Changecategory'])->name('changecategory');
    Route::post('product-status', [ProductController::class, 'Changestatus'])->name('changestatus');
    // Route::get('product/list', function () {
    //     return view('admin.products.listproduct');
    // })->name('product.list');

    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/add',[CategoryController::class,'viewCategory'])->name('category.add');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category-search-name', [CategoryController::class, 'search'])->name('category.search');
    // Order routes
    Route::get('order/list',[OrderController::class,'index'])->name('order.list');
    Route::post('order/updateStatus',[OrderController::class, "updateStatus"])->name('order.updateStatus');
    // user
    Route::get('/user-info', [AdminController::class, 'index'])->name('user-info');
    Route::post('/updateadmin', [AdminController::class, 'editAdmin'])->name('profile.update');
    Route::post('/updateInfoAdmin', [AdminController::class, 'editInfoAdmin'])->name('infoAdmin.update');
    Route::post('/upload', [AuthController::class, 'uploadImageUserInfo'])->name('file.upload'); // ảnh user info

    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

    // transaction 
     Route::get('transaction',[TransactionController::class,'index'])->name('transaction.index');
});
