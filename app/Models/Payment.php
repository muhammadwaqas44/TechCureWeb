<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['patient_id', 'practitioner_id', 'appointment_id', 'transaction_id', 'date', 'payment_type', 'amount', 'payment_method', 'payment_status','transaction_ref_number'];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'practitioner_id', 'id');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id', 'id');
    }
}
