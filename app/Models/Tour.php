<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    protected $table = 'tours';

    public function batiments()
    {
        return $this->belongsToMany(Batiment::class, 'pitstops', 'tour_id', 'batiment_id');
    }

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'distance',
        'adviced_locomotion'
    ];

}
