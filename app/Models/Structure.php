<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'parent_structure_id',
        'structure_type',
        'name',
        'code',
        'status',
        'description',
        'dimensions_json',
        'technical_attributes_json',
        'observations',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'dimensions_json' => 'array',
            'technical_attributes_json' => 'array',
        ];
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Structure::class, 'parent_structure_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Structure::class, 'parent_structure_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(VisitStructure::class);
    }
}
