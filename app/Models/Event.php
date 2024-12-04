<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'storyTelling' => ''
    ];
    protected $dates = ['deleted_at'];

    protected $casts = [
        'end_at' => 'datetime',
    ];
    public function batiments()
    {
        return $this->hasMany(Batiment::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function scopeActive($query)
    {
        return $query->where('end_at', '>', now());
    }
}
