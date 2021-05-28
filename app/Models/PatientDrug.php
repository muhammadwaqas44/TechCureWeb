<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientDrug extends Model
{
    protected $table = 'patient_drugs';
    protected $fillable = ['patient_id', 'drug_id', 'drug_title'];
}
