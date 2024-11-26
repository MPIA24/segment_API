<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public $incrementing = false; // L'ID n'est pas un entier auto-incrémenté
    protected $keyType = 'string'; // L'ID est une chaîne
}
