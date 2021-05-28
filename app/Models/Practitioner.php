<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\PractitionerResetPasswordNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Practitioner extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $appends = array('qualification_title');

    protected $guard = 'practitioner';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'description',
        'image',
        'qualification_id',
        'password',
        'license_no',
        'license_image',
        'prescription_pad_header_image',
        'prescription_pad_footer_image',
        'prescription_pad_sidebar_image',
        'prescription_pad_other_image',
        'status',
        'agora_app_id',
        'agora_app_token',
        'agora_app_certificate',
        'agora_app_channel',
        'last_login',
        'token',
        'device_type',
    ];

    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialty', 'practitioner_specialties');
    }

    public function clinics()
    {
        return $this->hasMany('App\Models\PractitionerClinics', 'practitioner_id', 'id');
    }

    public function getClinics()
    {
        return $this->belongsToMany('App\Models\Clinic', 'practitioner_clinics', 'practitioner_id', 'clinic_id')->where('status', 1);
    }

    public function practitionerClinics()
    {
        return $this->hasMany('App\Models\PractitionerClinics', 'practitioner_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PractitionerResetPasswordNotification($token));
    }

    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification', 'qualification_id', 'id');
    }

    public function days()
    {
        return $this->hasMany('App\Models\PractitionerClinicDay', 'practitioner_clinic_id', 'id');
    }

    public function practitionerAppointments()
    {
        $appointmentCount = Appointment::where('practitioner_id', $this->id)->count();
        return $appointmentCount;
    }

    public function practitionerPatients()
    {
        $patientIds = Appointment::where('practitioner_id', $this->id)->pluck('patient_id')->toArray();
        $patientUniqueIds = array_unique($patientIds);
        $practitionerPatientsCount = Patient::whereIn('id', $patientUniqueIds)->count();
        return $practitionerPatientsCount;
    }

    public function practitionerAssistants()
    {
        $practitionerAssistantsCount = PractitionerAssistant::where('practitioner_id', $this->id)->count();
        return $practitionerAssistantsCount;
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

    public function getQualificationTitleAttribute()
    {
        $rating = Qualification::where('id',$this->qualification_id)->first();
        if ($rating) {
            return $rating->title;
        } else {
            return null;
        }
    }
}
