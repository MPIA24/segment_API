<?php

namespace App\Providers;

use App\Events\Registered;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider

{
    protected $listen = [
        Registered::class => [
            SendWelcomeEmail::class,
        ],
    ];
}

