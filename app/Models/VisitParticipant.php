<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'farm_contact_id',
        'user_id',
        'participant_type',
        'name',
        'role_name',
        'email',
        'phone',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function farmContact(): BelongsTo
    {
        return $this->belongsTo(FarmContact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
