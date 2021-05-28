<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalConfigurationMedication extends Model
{
    protected $table = 'hospital_config_medications';
    protected $fillable = [
        'hospital_config_id',
        'medication_id',
        'medication_name',
    ];
}
