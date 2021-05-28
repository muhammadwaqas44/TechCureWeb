<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerClinicDay extends Model
{
    protected $fillable = [
        'practitioner_clinic_id',
        'day',
    ];
}
