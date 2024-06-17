<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\TeamController;
use App\Http\Controllers\Api\v1\TransactionController;
use App\Http\Controllers\Api\v1\OrderController;

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


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function () {
    Route::post('/send-otp', [UserController::class, 'sendOtp']);
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::group([
        'middleware' => 'api',
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

    Route::group(['prefix' => 'categories'], function ($router) {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::group(['prefix' => 'products'], function ($router) {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/{id}', [ProductController::class, 'show']);
        Route::get('/{id}', [ProductController::class, 'edit']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::post('/bycategory/{id}', [ProductController::class, 'getProductByCategory']);
    });
    // Route::group(['prefix' => 'team'],function($router){
    //     Route::get('/', [TeamController::cl])
    // });

    Route::get('/teammember', [TeamController::class, 'index']);
    Route::post('/responseWallet', [TransactionController::class, 'store']);
    Route::group(['prefix' => 'cart'], function ($router) {
        Route::post('/', [CartController::class, 'addToCart']);
        Route::get('/', [CartController::class, 'getToCart']);
        Route::delete('/{id}', [CartController::class, 'deleteCart']);
        Route::post('update/{id}', [CartController::class, 'updateToCart']);
        Route::post('clear-cart',[CartController::class,'clearCartUser']);
    });
    Route::post('/createorder', [OrderController::class, 'createOrder']);
});
