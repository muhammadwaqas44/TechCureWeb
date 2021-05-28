<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAllergy extends Model
{
    protected $table = 'patient_allergies';
    protected $fillable = ['patient_id', 'allergy_id', 'allergy_title'];
}
