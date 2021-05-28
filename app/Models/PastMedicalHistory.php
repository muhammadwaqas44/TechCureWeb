<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastMedicalHistory extends Model
{
    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'disease_id', 'disease_name', 'no_of_years', 'year', 'remarks'];
}
