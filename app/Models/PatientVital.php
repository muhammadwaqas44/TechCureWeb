<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVital extends Model
{
    protected $table = 'patient_vitals';

    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name', 'bp_sys', 'bp_dias', 'pulse', 'weight_lbs', 'weight_kgs', 'height_ft', 'height_in', 'height_cms', 'bmi', 'bsf', 'bsr', 'bp_sys_2', 'bp_dias_2', 'pulse_2', 'weight_lbs_2', 'weight_kgs_2', 'height_ft_2', 'height_in_2', 'height_cms_2', 'bmi_2', 'bsf_2', 'bsr_2'];
}
