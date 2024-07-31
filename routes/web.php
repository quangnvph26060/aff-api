<?php

use App\Events\NewOrderEvent;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\AdminController;

use App\Http\Controllers\Web\BrandController;
use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\ConfigController;

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MlmController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PackageController;
use App\Http\Controllers\Web\TeamController as WebTeamController;
use App\Http\Controllers\Web\TransactionController;
use App\Http\Middleware\checklogin;
use Predis\Configuration\Option\Prefix;
use PSpell\Config;
use GuzzleHttp\Client;
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


Route::get('test', function () {
    event(new App\Events\NewOrderEvent());
    return "Event has been sent!";
});

Route::get('wel', function () {
    $client = new Client();
    $accessToken = '3QSQMh-Lwoe1hHfGjfNW8G2Z7rseywHd7iKSJ-Ack5u7vGbVpBQBPJlzTK7fdeay8D5u0-ZWwIaNjHOmrS2i6ohs3ZISffzEB94TST_cvM0GqtfYn9R-JngW1N_RsFWERv54DQ2cnJ9LybOece7m07_4K1gIWliHNy07O8wkXqDovpHTcRQnNNI36apBwQTAVjqKRPQNX5DVhmegbjpqC2EPInFyhFC34kKA0VULzYb6sbeZevBVC5shJ262pCamTevFDQ2voavizMv0WPB4FZF6T067fOi5JUmw2AoMkdT4nqi7kAEnBGZgAoVQs8WP7emM8AphgojCfJK7WTITErtcCWICgfXwO-C-Kh67nLHUr5bee9t-O7wl142gnRbuNu0nPeR5ccbezs5ocB_V0dFuUnHDHKU60Cb9ludgAm'; 
    $appSecret = 'FT9yHjTKO3r5DDXTKUKh'; // Thay thế bằng app_secret của bạn

    // Tính toán appsecret_proof
    $appsecretProof = hash_hmac('sha256', $accessToken, $appSecret);

    $url = 'https://business.openapi.zalo.me/message/template';

    $data = [
        'phone' => '0382252561',
        'template_id' => '7895417a7d3f9461cd2e',
        'template_data' => [
            'ky' => '1',
            'thang' => '4/2020',
            'start_date' => '20/03/2020',
            'end_date' => '20/04/2020',
            'customer' => 'Nguyễn Thị Hoàng Anh',
            'cid' => 'PE010299485',
            'address' => 'VNG Campus, TP.HCM',
            'amount' => '100',
            'total' => '100000',
        ],
        'tracking_id' => 'tracking_id'
    ];

    try {
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => $accessToken,
            ],
            'json' => $data
        ]);

        $responseBody = json_decode($response->getBody(), true);
        return response()->json($responseBody);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
Route::get('ad', function () {
    return view('emails.order');
});
// Route::fallback(function () {
//     return view('errors.404');
// });
// end demo

Route::get('/admin/login', [AuthController::class, 'viewLogin'])->name('admin.login');
// Route::group(['prefix' => 'admin'], function () {
//     Route::get('/login', [AuthController::class, 'viewLogin'])->name('admin.login');
//     Route::get('/', [AuthController::class, 'viewLogin'])->name('admin.login');
// });
// Route::get('demo', [AuthController::class, 'getUser']);

Route::post('admin/login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth.user'])->prefix('admin')->name('admin.')->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
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
     // update status featrud product
    Route::post('/update-featured-product',[ProductController::class,'updateProductFeatured'])->name('product.featured');
    // Route::get('product/list', function () {
    //     return view('admin.products.listproduct');
    // })->name('product.list');

    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/add', [CategoryController::class, 'viewCategory'])->name('category.add');
    Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category-search-name', [CategoryController::class, 'search'])->name('category.search');
    // Order routes
    Route::get('order/list', [OrderController::class, 'index'])->name('order.list');
    Route::post('order/updateStatus', [OrderController::class, "updateStatus"])->name('order.updateStatus');
    // user
    Route::get('/user-info', [AdminController::class, 'index'])->name('user-info');
    Route::post('/updateadmin', [AdminController::class, 'editAdmin'])->name('profile.update');
    Route::post('/updateInfoAdmin', [AdminController::class, 'editInfoAdmin'])->name('infoAdmin.update');
    Route::post('/upload', [AuthController::class, 'uploadImageUserInfo'])->name('file.upload'); // ảnh user info

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/teammember', [WebTeamController::class, 'index'])->name('team');
    Route::get('/memberlist/{id}', [WebTeamController::class, 'getTeamMember'])->name('member');
    Route::get('/bestseller', [DashboardController::class, 'BestSeller'])->name('bestseller');
    // Route:get('bestseller', [])

    // transaction
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('transaction/{id}', [TransactionController::class, 'xulytransaction'])->name('xulytransaction');
    // notifycation
    // Route::get('/notify', [OrderController::class, 'orderCount'])->name('order.noti');


    Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('brand/add', [BrandController::class, 'addForm'])->name('brand.addForm');
    Route::post('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/edit/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('brand/delete/{id}', [BrandController::class, 'deltee'])->name('brand.delete');
    Route::get('brand/search', [BrandController::class, 'search'])->name('brand.search');

    Route::get('/config', [ConfigController::class, 'index'])->name('config');
    Route::post('/updateconfig', [ConfigController::class, 'updateConfig'])->name('updateconfig');
    // MLM
    Route::get('/mlm', [MlmController::class, 'index'])->name('mlm');
    // pakage
    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::get('/package-add', [PackageController::class, 'viewAdd'])->name('package.view');
    Route::post('/package-add', [PackageController::class, 'store'])->name('package.add');
    Route::get('/package-edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package-update/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::get('package/list', [PackageController::class, 'packageList'])->name('package.list');
    // get customer 
    Route::get('khach-hang',[AuthController::class,'getCustomer'])->name('khach-hang');
    Route::get('cong-tac-vien',[AuthController::class,'getCustomerAffilate'])->name('cong-tac-vien');

    Route::get('/comment',[CommentController::class,'index'])->name('comment');
    Route::get('/comment/{id}',[CommentController::class,'find'])->name('comment.find');
    Route::delete('/comments/{id}', [CommentController::class, 'delete'])->name('comments.delete');
});


// vue
Route::view('/{any?}', 'app')->where('any', '.*');
  
  