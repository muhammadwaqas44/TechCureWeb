<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalDay extends Model
{
    protected $fillable=[
      'hospital_id',
      'day',
    ];
}
