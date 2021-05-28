<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    // Type => 0 for Labs, 1 for Invoices, 2 for Others
    protected $fillable = ['title', 'type', 'image_url', 'patient_id'];
}
