<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use SoftDeletes;
    
    protected $fillable=[
        'title', 
        'slug',
        'status'
    ];

    public function getPractitioners()
    {
        return $this->belongsToMany('App\Models\Practitioner', 'practitioner_specialties', 'specialty_id', 'practitioner_id')->where('status', 1);
    }


}
