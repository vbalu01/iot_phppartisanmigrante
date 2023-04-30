<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Elszivo extends Model
{
    use HasFactory;
    public function Elszivo_Termelogepek(): BelongsToMany
    {
        return $this->belongsToMany(Termelogep::class);
    }
    public function kwhSzenzor(): HasOne
    {
        return $this->hasOne(Sensor::class);
    }
}
