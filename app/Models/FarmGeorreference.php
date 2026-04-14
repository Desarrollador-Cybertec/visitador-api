<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmGeorreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'address',
        'town',
        'department',
        'map_url_reference',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
