<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalConfigurationFacility extends Model
{
    protected $table = 'hospital_config_facilities';
    protected $fillable = [
        'hospital_config_id',
        'facility_id',
        'facility_name',
    ];
}
