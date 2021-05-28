<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionTemplate extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'slug', 'description', 'practitioner_id', 'practitioner_name', 'is_favourite', 'status'];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'practitioner_id', 'id');
    }
}
