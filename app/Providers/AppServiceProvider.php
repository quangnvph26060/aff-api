<?php

namespace App\Providers;

use App\Http\View\Composers\ConfigComposer;
use App\Http\View\Composers\OrderComposer;
use App\Http\View\Composers\UserComposer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
                'admin/config',
                'admin/dashboard',
                'admin/product/add',
                'admin/product',
                'admin/category',
                'admin/category/add',
                'admin/user-info',
                'admin/order/list',
                'admin/teammember',
                'admin/transaction',
                'admin/mlm',
                'admin/package',
                'admin/brand/add',
                'admin/brand',
            ];
            $path = request()->path();
            Log::info("path:" . request()->path());
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
