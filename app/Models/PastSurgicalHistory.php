<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastSurgicalHistory extends Model
{
    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'surgery_id', 'surgery_name', 'no_of_years', 'year', 'remarks'];
}
