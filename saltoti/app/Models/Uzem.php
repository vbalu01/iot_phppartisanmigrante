<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Uzem extends Model
{
    use HasFactory;
    public function Uzem_Termelogepek(): HasMany
    {
        return $this->hasMany(Termelogep::class);
    }
}
