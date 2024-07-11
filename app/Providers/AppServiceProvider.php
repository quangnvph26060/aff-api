<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigComposer;
use App\Http\View\Composers\OrderComposer;
use App\Http\View\Composers\UserComposer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
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
            ];
            $path = Route::currentRouteName();
            
         
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
