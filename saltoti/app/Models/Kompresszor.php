<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kompresszor extends Model
{
    use HasFactory;
    public function kwhSzenzor(): HasOne
    {
        return $this->hasOne(Sensor::class,"kwhSzenzor");
    }
    public function levegoSzenzor(): HasOne
    {
        return $this->hasOne(Sensor::class,"levegoSzenzor");
    }
}
