<?php

namespace App\Listeners;

use App\User;
use App\Events\TicketCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;

class TicketCreatedListener
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
    public function handle(TicketCreated $event)
    {
        $roles = ['owner', 'administrator'];
        $admins = User::whereHas('roles', static function($q) use ($roles) {
            return $q->whereIn('name', $roles);
        })->get();

        Notification::send($admins, new TicketCreatedNotification($event->ticket));
    }
}
