<?php

namespace App\Notifications;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservaCreada extends Notification
{
    use Queueable;

    public $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tu reserva fue registrada')
                    ->greeting('¡Hola ' . $notifiable->name . '!')
                    ->line('Has creado una reserva para el servicio: ' . $this->reserva->servicio)
                    ->line('Fecha: ' . $this->reserva->fecha)
                    ->line('Hora: ' . $this->reserva->hora)
                    ->line('Estado: ' . ucfirst($this->reserva->estado))
                    ->line('¡Gracias por usar nuestra plataforma!');
    }
}