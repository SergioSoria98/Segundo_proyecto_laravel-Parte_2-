<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationToTheOwner implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(MessageWasReceived $event): void
    {
        //var_dump('Notificar al dueño');
        
        $message = $event->message;

        Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){
            $m->from($message->email, $message->nombre)
            ->to('descobic1998@gmail.com', 'Sergio')
            ->subject('Tu mensaje fue recibido');
        });
        
    }
}
