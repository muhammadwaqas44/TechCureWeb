<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientPrescription extends Model
{
    protected $fillable = [
        'illness_history', 
        'vital_assessments', 
        'clinical_examinations',
        'presenting_complaints',
        'diagnosis',
        'investigations', 
        'family_history',
        'referral',
        'follow_up',
        'patient_id',
        'practitioner_id',
        'clinic_id',
    ];

    public function medications()
    {
        return $this->belongsToMany('App\Models\Medication', 'prescription_medications');
    }

    public function allergies()
    {
        return $this->belongsToMany('App\Models\Allergy', 'prescription_allergies');
    }

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'practitioner_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo('App\Models\Clinic', 'clinic_id', 'id');
    }
}
