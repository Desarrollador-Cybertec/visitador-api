<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'structure_id',
        'section',
        'category',
        'severity',
        'title',
        'description',
        'recommendation',
        'is_blocking',
        'sort_order',
    ];

    protected function casts(): array
    {
        return ['is_blocking' => 'boolean'];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
