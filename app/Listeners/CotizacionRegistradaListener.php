<?php

namespace App\Listeners;

use App\Events\CotizacionRegistradaEvent;
use App\Models\User;
use App\Notifications\CotizacionRegistradaNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class CotizacionRegistradaListener
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
    public function handle(CotizacionRegistradaEvent $event)
    {
        $cliente = User::select("*")->where("id",Auth()->user()->id)->get();
        
        Notification::send($cliente, new CotizacionRegistradaNotification($event->cotizacion));
    }
}
