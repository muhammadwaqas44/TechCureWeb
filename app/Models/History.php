<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'patient_id',
        'patient_name',
        'practitioner_id',
        'practitioner_name',
        'patient_visit_id',
        'description',
    ];
}
