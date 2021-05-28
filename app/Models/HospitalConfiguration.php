<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalConfiguration extends Model
{
    use SoftDeletes;

    protected $table = 'hospital_configs';

    protected $fillable = [
        'key',
        'slug',
        'hospital_id',
        'hospital_name',
    ];

    public function facilities()
    {
        return $this->hasMany('App\Models\HospitalConfigurationFacility', 'hospital_config_id');

    }

    public function latTests()
    {
        return $this->hasMany('App\Models\HospitalConfigurationLabTest', 'hospital_config_id');

    }

    public function medications()
    {
        return $this->hasMany('App\Models\HospitalConfigurationMedication', 'hospital_config_id');

    }

    public function specialties()
    {
        return $this->hasMany('App\Models\HospitalConfigurationSpecialty', 'hospital_config_id');

    }
}
