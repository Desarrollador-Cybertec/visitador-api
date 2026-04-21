<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitMediaAnnotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_media_id',
        'title',
        'caption',
        'sequence_label',
        'phase',
        'created_by',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(VisitMedia::class, 'visit_media_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
