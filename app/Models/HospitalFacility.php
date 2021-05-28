<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalFacility extends Model
{
    protected $fillable = [
        'hospital_id',
        'facility_id',
        'facility_name',
    ];
}
