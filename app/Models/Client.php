<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'nit',
        'email',
        'phone_number',
    ];

    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class);
    }
}
