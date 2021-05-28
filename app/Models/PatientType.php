<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientType extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'discount_percentage', 'start_date', 'end_date', 'status'];
}
