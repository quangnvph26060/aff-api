<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigComposer;
use App\Http\View\Composers\OrderComposer;
use App\Http\View\Composers\UserComposer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('truncate', function ($expression) {
            return "<?php echo Str::limit($expression, 50); ?>";
        });
        // View::composer('*', UserComposer::class);
        // View::composer('*', OrderComposer::class);
      
        View::composer('*', function ($view) {  
            $excludedRoutes = [
                'admin.login',
                'admin.dashboard',
                'admin.user-info',
                'admin.config',
                'admin.product.add',
                'admin.product.store',
                'admin.product.edit',
                'admin.category.add',
                'admin.category.index',
                'admin.category.edit',
                'admin.brand.addForm',
                'admin.brand.index',
                'admin.brand.edit',
                'admin.order.list',
                'admin.team',
                'admin.transaction.index',
                'admin.mlm',
                'admin.package',
                'admin.khach-hang',
                'admin.cong-tac-vien',
                'admin.package.view',
                'admin.package.edit',
                'admin.package.list',
                'admin.category.search',
                'admin.product.search',
                'admin.product.filter',
                'admin.comment',
                'admin.comment.find',
                'admin.member',
                'admin.pay'
            ];
            $path = Route::currentRouteName();
            //  Log::info('demo path: ' . $path);
         
            if ( !request()->path() === 'api/v1/send-otp' ) {
                View::composer('*', UserComposer::class);
                View::composer('*', OrderComposer::class);
                View::composer('*', ConfigComposer::class);
            }
            if ( in_array($path, $excludedRoutes) ) {
                View::composer('*', UserComposer::class);
                View::composer('*', OrderComposer::class);
                View::composer('*', ConfigComposer::class);
            }
        });
    }
}
