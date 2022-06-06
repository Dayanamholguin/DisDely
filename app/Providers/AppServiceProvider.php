<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Providers\MailMessage;
use App\Providers\Lang;

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

         //Personalizar Email
         VerifyEmail::$toMailCallback = function ($notifiable, $verificationUrl) {

            return (new MailMessage)
                ->subject(Lang::get('Recuperar contraseña'))
                ->greeting('Hola, ' . $notifiable->name)
                ->line(Lang::get('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.'))
                ->action(Lang::get('Reestablecer contraseña'), $verificationUrl)
                ->line(Lang::get('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.'))
                ->salutation('¡Saludos!');
        };
    }
}
