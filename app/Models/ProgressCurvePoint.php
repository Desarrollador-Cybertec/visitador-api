<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressCurvePoint extends Model
{
    use HasFactory;

    protected $fillable = ['progress_report_id', 'date', 'projected_percent', 'actual_percent'];

    protected function casts(): array
    {
        return ['date' => 'date'];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(ProgressReport::class, 'progress_report_id');
    }
}
