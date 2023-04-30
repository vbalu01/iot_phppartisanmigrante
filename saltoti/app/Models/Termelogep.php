<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Termelogep extends Model
{
    use HasFactory;
    public function kwhSzenzor(): HasOne
    {
        return $this->hasOne(Sensor::class,"kwhSzenzor");
    }
    public function darabszenzor(): HasOne
    {
        return $this->hasOne(Sensor::class,"darabszenzor");
    }
}
