<?php

namespace App\Listeners;

use App\Events\CotizacionRegistradaAdminEvent;
use App\Models\User;
use App\Notifications\CotizacionRegistradaAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class CotizacionRegistradaAdminListener
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
    public function handle(CotizacionRegistradaAdminEvent $event)
    {
        // select * from users 
        // join model_has_roles on model_has_roles.model_id=users.id
        // join roles on roles.id=model_has_roles.role_id
        // where roles.name = 'Admin';
        $admin = User::select('*')
        ->join("model_has_roles", "model_has_roles.model_id", "users.id")
        ->join("roles", "roles.id", "model_has_roles.role_id")
        ->where("roles.name", "Admin")
        ->get();
        // $cliente = User::select("*")->where("id", $admin->id)->get();
        // dd($admin);
        Notification::send($admin, new CotizacionRegistradaAdminNotification($event->cotizacion));
    }
}
