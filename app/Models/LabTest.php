<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type_id',
        'fasting',
        'instructions',
        'lab_id',
        'status',
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function labTestType()
    {
        return $this->belongsTo(LabTestType::class, 'type_id');
    }

    public function favouriteLabTests()
    {
        return $this->hasMany(PractitionerLabTest::class, 'lab_test_id');
    }
}
