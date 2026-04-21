<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'signed_by_name',
        'signed_by_role',
        'signed_by_type',
        'signature_file_path',
        'signed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return ['signed_at' => 'datetime'];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }
}
