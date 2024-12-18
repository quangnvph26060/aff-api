<?php

use App\Http\Controllers\Api\DemoController;
use App\Http\Controllers\Api\v1\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\TeamController;
use App\Http\Controllers\Api\v1\TransactionController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Web\TeamController as WebTeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('find-password', [UserController::class, 'resetPassword'])->name('findPass');
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function () {
    Route::post('/send-otp', [UserController::class, 'sendOtp'])->name('send_otp');
    Route::post('/register', [UserController::class, 'store']);
    Route::post('auth/login', [AuthController::class, 'login'])->name('api.login');
    Route::group([
        'middleware' => ['api'],

        'prefix' => 'auth'
    ], function ($router) {
        //Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::get('get-user', [AuthController::class, 'getUser']);
        

    });

    Route::group([
        'middleware' => ['api', 'jwt.auth'],
        'prefix' => 'user'
    ], function ($router) {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::post('edit-user',[UserController::class,'editUser']);
    Route::post('update-user-info',[UserController::class,'editInfoAdmin']);
    Route::group(['prefix' => 'categories'], function ($router) {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);

    });
    Route::group(['prefix' => 'packages'], function ($router) { 
        Route::get('/', [PackageController::class, 'index']);
        Route::post('/find-package/{id}', [PackageController::class, 'DetailPackage']);
        Route::post('/createorderpackage', [PackageController::class, 'createPackageOrder'])->name('create.orderpackage');
    });
    Route::group(['prefix' => 'products'], function ($router) { 
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/{id}', [ProductController::class, 'show']);
       // Route::get('/{id}', [ProductController::class, 'edit']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::post('/bycategory/{id}', [ProductController::class, 'getProductByCategory']);
        Route::get('/get-product-top', [ProductController::class, 'getProductTop']);
    });
    Route::post('search-product',[ProductController::class,'searchProduct'])->name('search_product');
    // Route::group(['prefix' => 'team'],function($router){
    //     Route::get('/', [TeamController::cl])
    // });\
    Route::get('/memberlist/{id}', [TeamController::class, 'getTeamMember']);

    Route::get('/teammember', [TeamController::class, 'index']);
    Route::post('changegroup',[TeamController::class,'changeGroup']);
    Route::post('/responseWallet', [TransactionController::class, 'store']);

    Route::get('/transactionlist', [TransactionController::class, 'index']);
    Route::get('/waiting-for-payment', [TransactionController::class, 'WaitingForPayment']);
    Route::group(['prefix' => 'cart'], function ($router) {
        Route::post('/', [CartController::class, 'addToCart']);
        Route::get('/', [CartController::class, 'getToCart']);
        Route::delete('/{id}', [CartController::class, 'deleteCart']);
        Route::post('update/{id}', [CartController::class, 'updateToCart']);
        Route::post('clear-cart',[CartController::class,'clearCartUser']);
    });
    Route::post('/createorder', [OrderController::class, 'createOrder'])->name('create.order');
    Route::get('/get-order', [OrderController::class, 'index']);
    Route::get('/order-detail', [OrderController::class, 'getOrderNew']);
    Route::post('/delete-order-user', [OrderController::class, 'delOrderUser']);
    Route::get('/get-order-month', [OrderController::class, 'getOrderInMonth']);
    Route::get('/get-methods', [OrderController::class, 'getMethodPayment']);
    Route::get('/banner-brand',[BrandController::class,'imageBrand'])->name('banner.brand');
    Route::get('/get-bank',[BrandController::class,'getBank']);
    Route::group(['prefix' => 'comment'], function ($router) {
        Route::post('/', [CommentController::class, 'store']);
        Route::post('/get-comment', [CommentController::class, 'index']);
        Route::delete('/{id}', [CommentController::class, 'delete']);
    });
});

Route::post('/order-count',[OrderController::class,'orderCount'])->name('count.order');
Route::post('/update-status-notify',[OrderController::class,'updateNotify'])->name('status.notify');
Route::post('/handle-status-notify',[OrderController::class,'handleAllNotify'])->name('handle.status.notify');
Route::get('/get-config',[BrandController::class,'getConfig']);