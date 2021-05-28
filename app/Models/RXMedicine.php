<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RXMedicine extends Model
{
    protected $table = 'rx_medicines';
    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'medicine_id', 'medicine_name', 'dose_id', 'dose_name', 'unit_id', 'unit_name', 'frequency_id', 'frequency_name', 'duration_id', 'duration_name', 'diagnosis_type_id', 'diagnosis_type_name'];

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medication', 'medicine_id', 'id');
    }
}
