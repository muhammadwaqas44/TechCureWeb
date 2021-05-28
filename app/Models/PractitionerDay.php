<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerDay extends Model
{
    protected $fillable = [
        'practitioner_id', 
        'day',
    ];
}
