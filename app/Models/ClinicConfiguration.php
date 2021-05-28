<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicConfiguration extends Model
{
    use SoftDeletes;

    protected $table = 'clinic_configs';

    protected $fillable = [
        'key',
        'slug',
        'clinic_id',
        'clinic_name',
    ];

    public function facilities()
    {
        return $this->hasMany('App\Models\ClinicConfigurationFacility', 'clinic_config_id');

    }

    public function latTests()
    {
        return $this->hasMany('App\Models\ClinicConfigurationLabTest', 'clinic_config_id');

    }

    public function medications()
    {
        return $this->hasMany('App\Models\ClinicConfigurationMedication', 'clinic_config_id');

    }

    public function specialties()
    {
        return $this->hasMany('App\Models\ClinicConfigurationSpecialty', 'clinic_config_id');

    }
}
