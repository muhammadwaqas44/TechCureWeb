<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMedicalHistory extends Model
{
    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'relation_id', 'relation_name', 'disease_id', 'disease_name', 'no_of_years', 'year', 'deceased_status', 'remarks'];
}
