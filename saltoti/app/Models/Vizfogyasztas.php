<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vizfogyasztas extends Model
{
    use HasFactory;
    public function fogyasztas(): HasOne
    {
        return $this->hasOne(Sensor::class);
    }
}
