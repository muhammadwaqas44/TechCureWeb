<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'about',
        'address',
        'email',
        'contact_no',
        'all_time',
        'from_time',
        'to_time',
        'status',
    ];

    public function days()
    {
        return $this->hasMany('App\Models\HospitalDay');

    }

    public function facilities()
    {
        return $this->hasMany('App\Models\HospitalFacility');

    }

    public function departments()
    {
        return $this->hasMany('App\Models\HospitalDepartment');

    }
}
