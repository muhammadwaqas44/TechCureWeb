<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVisitPrescription extends Model
{
    protected $table = 'patient_visit_prescriptions';

    protected $fillable = ['patient_visit_id', 'prescription'];
}
