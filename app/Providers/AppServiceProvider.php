<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES');
        ##setlocale(LC_TIME, 'es_ES.utf8');
        // Carbon::setUtf8(true);
    }
}
