<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'slug', 'generic_name', 'dose_id', 'dose', 'unit_id', 'unit', 'frequency_id', 'frequency', 'duration_id', 'duration', 'diagnosis_type_id', 'diagnosis_type', 'status'];
}
