<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class CheckExpiredEvents extends Command
{
    protected $signature = 'events:check-expired';
    protected $description = 'Check and handle expired events';

    public function handle()
    {
        $now = Carbon::now();
        $expiredEvents = Event::where('end_at', '<', $now)->get();

        foreach ($expiredEvents as $event) {
            $event->delete(); // Soft delete
            event(new \App\Events\EventExpired($event)); // Déclencher un événement
        }

        $this->info('Expired events processed successfully.');
    }
}
