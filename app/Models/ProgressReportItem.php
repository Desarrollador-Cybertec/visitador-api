<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressReportItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress_report_id',
        'structure_id',
        'section_name',
        'activity_code',
        'activity_name',
        'status',
        'advance_percent',
        'pending_percent',
        'notes',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(ProgressReport::class, 'progress_report_id');
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
