<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    protected $table = 'patient_visits';

    protected $fillable = ['practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'appointment_id', 'visit_number', 'payment_status', 'total_duration', 'notes_internal', 'notes_printed', 'revise_of', 'next_visit', 'next_visit_date', 'pdf_report', 'status'];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }

    public function patientVital()
    {
        return $this->hasOne('App\Models\PatientVital', 'patient_visit_id', 'id');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id', 'id');
    }
}
