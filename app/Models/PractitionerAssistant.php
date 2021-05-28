<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerAssistant extends Model
{
    protected $fillable = ['assistant_id', 'practitioner_id'];
}
