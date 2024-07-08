<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\EventRegister' => [
            'App\Listeners\SendMailRegister',
        ],
        'App\Events\EventForgetPass' => [
            'App\Listeners\SendMailForgetPass',
        ],
        'App\Events\EventOrder' => [
            'App\Listeners\SendMailOrder',
        ],
        'App\Events\EventSendMailBrand' => [
            'App\Listeners\SendMailBrand',
        ],
        'App\Events\EventSendOTP' => [
            'App\Listeners\SendOTP',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
