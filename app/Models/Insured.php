<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Insured extends Authenticatable
{
    use HasFactory, HasUuids;

    public function insurence()
    {
        return $this->belongsTo(Insurence::class, 'kk_label', 'kk_label');
    }
}
