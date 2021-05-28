<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'patient_type_id',
        'practitioner_id',
        'clinic_id',
        'assistant_id',
        'date',
        'time_slot',
        'practitioner_url',
        'patient_url',
        'type',
        'status',
        'otp',
        'check_in',
        'practitioner_start',
        'appointment_complete'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'practitioner_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo('App\Models\Clinic', 'clinic_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }

    public function patientType()
    {
        return $this->belongsTo('App\Models\PatientType', 'patient_type_id', 'id');
    }

    public function patientVisits()
    {
        return $this->hasMany(PatientVisit::class)->orderBy('created_at','DESC');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'id', 'appointment_id');
    }

    public function paymentPaid()
    {
        return $this->hasOne('App\Models\Payment', 'appointment_id')->where('payment_status', 'Paid');
    }

}
