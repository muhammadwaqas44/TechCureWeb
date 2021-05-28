<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicConfigurationLabTest extends Model
{
    protected $table = 'clinic_config_lab_tests';
    protected $fillable = [
        'clinic_config_id',
        'lab_test_id',
        'lab_test_name',
    ];
}
