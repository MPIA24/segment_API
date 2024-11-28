<?php

namespace App\Observers;

use App\Http\Controllers\VisitedController;
use App\Models\TripPitstop;
use Illuminate\Http\Request;

class TripPitstopObserver
{
    /**
     * Handle the TripPitstop "created" event.
     */
    public function created(TripPitstop $tripPitstop): void
    {
        //
    }

    /**
     * Handle the TripPitstop "updated" event.
     */
        public function updated(TripPitstop $pitstop)
    {
        // Vérifier si l'étape a été marquée comme visitée
        if ($pitstop->status === 'visited' && $pitstop->visited_at) {
            app(VisitedController::class)->store(new Request([
                'batiment_id' => $pitstop->batiment_id,
                'user_id' => $pitstop->trip->user_id,
            ]));
        }
    }

    /**
     * Handle the TripPitstop "deleted" event.
     */
    public function deleted(TripPitstop $tripPitstop): void
    {
        //
    }

    /**
     * Handle the TripPitstop "restored" event.
     */
    public function restored(TripPitstop $tripPitstop): void
    {
        //
    }

    /**
     * Handle the TripPitstop "force deleted" event.
     */
    public function forceDeleted(TripPitstop $tripPitstop): void
    {
        //
    }
}
