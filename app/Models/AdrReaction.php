<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdrReaction extends Model
{
    protected $guarded = [];

    public function reaction()
    {
        return $this->belongsTo('App\Models\Reaction', 'reaction_id', 'id');
    }
}
