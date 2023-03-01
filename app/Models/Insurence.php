<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurence extends Model
{
    use HasFactory, HasUuids;

    public function insured()
    {
        return $this->hasMany(Insured::class, 'kk_label', 'kk_label');
    }
}
