<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\PatientResetPasswordNotification;
use App\Models\Appointment;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Patient extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guard = 'patient';

    protected $fillable = [
        'mr_number',
        'patient_type_id',
        'patient_type_title',
        'name',
        'email',
        'phone',
        'image',
        'address',
        'gender',
        'dob',
        'age',
        'weight_kgs',
        'weight_lbs',
        'height_ft',
        'height_in',
        'height_cms',
        'marital_status',
        'hospitalization',
        'currently_on_drug',
        'payment_status',
        'time_waste_flag_condition',
        'critical_flag_condition',
        'password',
        'status',
        'last_login',
        'token',
        'device_type',
    ];

    public function reports()
    {
        return $this->hasMany('App\Models\PatientReport', 'patient_id', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany('App\Models\PatientPrescription', 'patient_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PatientResetPasswordNotification($token));
    }

    public function visitCount($doctorId, $patientId){
        $count = Appointment::where('practitioner_id', $doctorId)
        ->where('patient_id', $patientId)
        ->where('status', 4)
        ->count();

        return $count;
    }

    public function allergies()
    {
        return $this->hasMany('App\Models\PatientAllergy', 'patient_id', 'id');
    }

    public function drugs()
    {
        return $this->hasMany('App\Models\PatientDrug', 'patient_id', 'id');
    }

    public function visits()
    {
        $patientVisitsCount = PatientVisit::where('patient_id', $this->id)->count();
        return $patientVisitsCount;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['ll' => $this->last_login];
    }

    public function _check()
    {
        if ($this->status == 0)
            return [
                'status' => 4,
                'message' => 'Your Account Has Been Deactivated.',
            ];
        return null;
    }
}
