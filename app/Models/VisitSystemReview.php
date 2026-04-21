<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitSystemReview extends Model
{
    use HasFactory;

    protected $fillable = ['visit_id', 'structure_id', 'system_id', 'status', 'summary', 'recommendation'];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(SystemsCatalog::class, 'system_id');
    }
}
