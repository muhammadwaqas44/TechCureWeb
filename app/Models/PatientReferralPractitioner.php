<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientReferralPractitioner extends Model
{
    protected $table = 'patient_referral_practitioners';

    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'referral_practitioner_id', 'referral_practitioner_name'];
}
