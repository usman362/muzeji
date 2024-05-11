<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $user = $event->user;
        $password = $event->password;
        $user->notify(new UserCreatedNotification($user,$password));
    }
}
