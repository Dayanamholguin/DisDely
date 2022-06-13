<?php

namespace App\Providers;

use App\Events\cambiarEstadoCotizacionEvent;
use App\Events\CotizacionRegistradaEvent;
use App\Events\CotizacionRegistradaAdminEvent;
use App\Listeners\cambiarEstadoCotizacionListener;
use App\Listeners\CotizacionRegistradaListener;
use App\Listeners\CotizacionRegistradaAdminListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CotizacionRegistradaEvent::class => [
            CotizacionRegistradaListener::class,
        ],

        CotizacionRegistradaAdminEvent::class => [
            CotizacionRegistradaAdminListener::class,
        ],

        cambiarEstadoCotizacionEvent::class => [
            cambiarEstadoCotizacionListener::class,
        ]
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
