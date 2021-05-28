<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicDepartment extends Model
{
    protected $fillable = ['clinic_id', 'department_id', 'department_name'];
}
