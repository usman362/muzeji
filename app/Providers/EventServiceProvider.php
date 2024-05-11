<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\UserCreated' => [
            'App\Listeners\SendUserCreatedNotification',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
