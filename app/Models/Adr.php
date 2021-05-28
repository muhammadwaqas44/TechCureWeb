<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adr extends Model
{
    protected $guarded = [];

    public function reactions()
    {
        return $this->hasMany(AdrReaction::class, 'adr_id');
    }
}
