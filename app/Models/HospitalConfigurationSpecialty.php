<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalConfigurationSpecialty extends Model
{
    protected $table = 'hospital_config_specialties';
    protected $fillable = [
        'hospital_config_id',
        'specialty_id',
        'specialty_name',
    ];
}
