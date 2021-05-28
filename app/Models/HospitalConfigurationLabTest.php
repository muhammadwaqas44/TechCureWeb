<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalConfigurationLabTest extends Model
{
    protected $table = 'hospital_config_lab_tests';
    protected $fillable = [
        'hospital_config_id',
        'lab_test_id',
        'lab_test_name',
    ];
}
