<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'farm_id',
        'visit_type_id',
        'created_by',
        'assigned_to',
        'title',
        'subject',
        'status',
        'started_at',
        'ended_at',
        'report_date',
        'city',
        'department',
        'context',
        'development',
        'general_observations',
        'conclusions',
        'internal_notes',
        'source',
        'external_reference',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'report_date' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function visitType(): BelongsTo
    {
        return $this->belongsTo(VisitType::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function structures(): HasMany
    {
        return $this->hasMany(VisitStructure::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(VisitParticipant::class);
    }

    public function signatures(): HasMany
    {
        return $this->hasMany(VisitSignature::class);
    }

    public function findings(): HasMany
    {
        return $this->hasMany(VisitFinding::class);
    }

    public function commitments(): HasMany
    {
        return $this->hasMany(VisitCommitment::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(VisitMedia::class);
    }

    public function formResponses(): HasMany
    {
        return $this->hasMany(VisitFormResponse::class);
    }

    public function systemReviews(): HasMany
    {
        return $this->hasMany(VisitSystemReview::class);
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(VisitMeasurement::class);
    }

    public function materialRequests(): HasMany
    {
        return $this->hasMany(VisitMaterialRequest::class);
    }

    public function generatedReports(): HasMany
    {
        return $this->hasMany(GeneratedReport::class);
    }
}
