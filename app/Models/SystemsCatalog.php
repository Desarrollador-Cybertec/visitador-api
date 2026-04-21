<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemsCatalog extends Model
{
    use HasFactory;

    protected $table = 'systems_catalog';

    protected $fillable = ['code', 'name', 'category', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(VisitSystemReview::class, 'system_id');
    }

    public function materialRequests(): HasMany
    {
        return $this->hasMany(VisitMaterialRequest::class, 'system_id');
    }
}
