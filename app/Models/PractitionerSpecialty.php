<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerSpecialty extends Model
{
    protected $fillable = ['practitioner_id', 'specialty_id'];
}
