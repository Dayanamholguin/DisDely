<?php

namespace App\Listeners;

use App\Events\cambiarEstadoCotizacionEvent;
use App\Models\User;
use App\Notifications\cambioEstadoDeCotizacion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class cambiarEstadoCotizacionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(cambiarEstadoCotizacionEvent $event)
    {
        // SELECT users.* FROM `cotizaciones` join users on cotizaciones.idUser=users.id where cotizaciones.id=3;
        $cliente = User::select("*")->join("cotizaciones", "cotizaciones.idUser", "users.id")->where("cotizaciones.id", $event->cotizacion->id)->get();
        // dd($cliente);
        Notification::send($cliente, new cambioEstadoDeCotizacion($event->cotizacion));
    }
}
