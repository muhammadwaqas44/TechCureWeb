<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\AssistantResetPasswordNotification;

class Assistant extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'address', 'description', 'image', 'qualification_id', 'password', 'status'];

    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialty', 'assistant_specialties');
    }

    public function practitioners()
    {
        return $this->belongsToMany('App\Models\Practitioner', 'practitioner_assistants');
    }

    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification', 'qualification_id', 'id');
    }

    public function assistantAppointments()
    {
        $practitionerIds = PractitionerAssistant::select('practitioner_id')->where('assistant_id', $this->id)->pluck('practitioner_id')->toArray();

        $assistantAppointmentsCount = Appointment::whereIn('practitioner_id', $practitionerIds)->count();

        return $assistantAppointmentsCount;
    }

    public function assistantPatients()
    {
        $practitionerIds = PractitionerAssistant::select('practitioner_id')->where('assistant_id', $this->id)->pluck('practitioner_id')->toArray();

        $patientAppointmentsIds = Appointment::whereIn('practitioner_id', $practitionerIds)->pluck('patient_id')->toArray();

        $patientUniqueIds = array_unique($patientAppointmentsIds);

        $assistantPatientsCount = Patient::whereIn('id', $patientUniqueIds)->count();

        return $assistantPatientsCount;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AssistantResetPasswordNotification($token));
    }

}
