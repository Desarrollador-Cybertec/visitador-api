<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitCommitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'structure_id',
        'description',
        'responsible_type',
        'responsible_user_id',
        'responsible_name',
        'due_date',
        'status',
        'completion_notes',
    ];

    protected function casts(): array
    {
        return ['due_date' => 'date'];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }
}
