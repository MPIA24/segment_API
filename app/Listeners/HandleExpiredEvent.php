<?php

namespace App\Listeners;

use App\Events\EventExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandleExpiredEvent
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
    public function handle(EventExpired $event)
    {
        // Actions à effectuer
        Log::info("Event {$event->event->name} has expired and actions are triggered.");
    }
}
