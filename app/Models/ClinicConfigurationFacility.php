<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicConfigurationFacility extends Model
{
    protected $table = 'clinic_config_facilities';
    protected $fillable = [
        'clinic_config_id',
        'facility_id',
        'facility_name',
    ];
}
