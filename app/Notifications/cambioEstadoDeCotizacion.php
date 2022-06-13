<?php

namespace App\Notifications;

use App\Models\Cotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class cambioEstadoDeCotizacion extends Notification
{
    use Queueable;

    private $cotizacion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cotizacion $cotizacion)
    {
        $this->cotizacion=$cotizacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Se ha cambiado el estado de la cotización, por favor, revisa dando clic en el botón.')
                    ->action('Clic aquí', url('/cotizacion/ver', $this->cotizacion))
                    ->line('Te damos las gracias por usar nuestra aplicación.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
