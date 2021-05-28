<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerClinics extends Model
{
    protected $appends = array('clinic_name');

    protected $table ='practitioner_clinics';
    protected $fillable = [
        'practitioner_id',
        'clinic_id',
        'physical_fee',
        'online_fee',
        'from_time',
        'to_time',
    ];

    public function days()
    {
        return $this->hasMany('App\Models\PractitionerClinicDay', 'practitioner_clinic_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo('App\Models\Clinic', 'clinic_id', 'id');
    }

    public function getClinicNameAttribute()
    {
        $clinic = Clinic::where('id',$this->clinic_id)->first();
        if ($clinic) {
            return $clinic->name;
        } else {
            return null;
        }
    }
}
