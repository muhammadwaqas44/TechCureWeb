<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'slug', 'drug_id', 'drug_title', 'status'];
}
