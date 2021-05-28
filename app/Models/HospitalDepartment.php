<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalDepartment extends Model
{
    protected $fillable = [
        'hospital_id',
        'department_id',
        'department_name',
    ];
}
