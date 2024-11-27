<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripPitstop extends Model
{
    protected $fillable = [
        'trip_id', 'batiment_id', 'visited_at', 'status',
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function batiment(): BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }
}

