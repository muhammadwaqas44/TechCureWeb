<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientLabTest extends Model
{
    protected $appends = ['recommended_lab_title'];
    protected $guarded = [];

    public function recommendedLabTest()
    {
        return $this->belongsTo(Lab::class, 'recommended_lab');
    }

    public function typeTest()
    {
        return $this->belongsTo(LabTestType::class, 'type_id');
    }

    public function getRecommendedLabTitleAttribute()
    {
        $rating = Lab::where('id', $this->recommended_lab)->first();
        if ($rating) {
            return $rating->title;
        } else {
            return null;
        }
    }
}
