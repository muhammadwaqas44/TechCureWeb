<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicConfigurationMedication extends Model
{
    protected $table = 'clinic_config_medications';
    protected $fillable = [
        'clinic_config_id',
        'medication_id',
        'medication_name',
    ];
}
