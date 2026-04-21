<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitMeasurement extends Model
{
    use HasFactory;

    protected $fillable = ['visit_id', 'structure_id', 'measurement_type', 'label', 'value', 'unit', 'notes'];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
