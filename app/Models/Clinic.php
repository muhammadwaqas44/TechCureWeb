<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ClinicResetPasswordNotification;

class Clinic extends Authenticatable
{
    use Notifiable;

    protected $guard = 'clinic';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'from_day',
        'to_day',
        'opening_time',
        'closing_time',
        'status',
        'all_day',
        'logo',
    ];

    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialty', 'clinic_specialties');
    }

    public function facilities()
    {
        return $this->belongsToMany('App\Models\Facility', 'clinic_facilities');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Models\Department', 'clinic_departments');
    }

    public function labTests()
    {
        return $this->belongsToMany('App\Models\LabTest', 'clinic_lab_tests');
    }

    public function medications()
    {
        return $this->belongsToMany('App\Models\Medication', 'clinic_medications');
    }

    public function getPractitioners()
    {
        return $this->belongsToMany('App\Models\Practitioner', 'practitioner_clinics', 'clinic_id', 'practitioner_id')->where('status', 1);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClinicResetPasswordNotification($token));
    }
}
