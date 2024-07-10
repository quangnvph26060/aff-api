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
            Log::info(request()->path());
            // Kiểm tra nếu route hiện tại không phải là 'create.order' hoặc 'api.send-otp' && !request()->path() === "api/v1/send-otp"
            if ( !request()->path() === 'api/v1/send-otp' ) {
                View::composer('*', UserComposer::class);
                View::composer('*', OrderComposer::class);
                View::composer('*', ConfigComposer::class);
            }
            if ( request()->path() === 'admin/dashboard' ) {
                View::composer('*', UserComposer::class);
                View::composer('*', OrderComposer::class);
                View::composer('*', ConfigComposer::class);
            }
        });
    }
}
