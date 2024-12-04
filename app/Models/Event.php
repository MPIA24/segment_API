<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function batiments()
    {
        return $this->hasMany(Batiment::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
