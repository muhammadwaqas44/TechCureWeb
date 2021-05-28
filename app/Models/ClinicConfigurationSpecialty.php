<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicConfigurationSpecialty extends Model
{
    protected $table = 'clinic_config_specialties';
    protected $fillable = [
        'clinic_config_id',
        'specialty_id',
        'specialty_name',
    ];
}
