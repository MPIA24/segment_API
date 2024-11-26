<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batiment extends Model
{
    use HasFactory;

    protected $table = 'batiments';

    protected $fillable = [
        'id',
        'name',
        'description',
        'latitude',
        'longitude',
    ];

    public function VisitedBatiments() : HasMany
    {
        return $this->hasMany(VisitedBatiments::class);
    }


    public $incrementing = false;
    protected $keyType = 'string';
}
