<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitedBatiments extends Model
{
    use HasFactory;
    protected $table = 'batiments_users';

    protected $fillable = [
        'batiment_id',
        'user_id',
        'visited_at',
    ];

    public function Batiment() : BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }

    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
