<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientSugarChart extends Model
{
    protected $table = 'patient_sugar_charts';

    protected $fillable = ['patient_visit_id', 'practitioner_id', 'practitioner_name', 'patient_id', 'patient_name',
    
    'day_1_before_breakfast', 'day_1_2_hours_after_breakfast', 'day_1_before_lunch', 'day_1_2_hours_after_lunch', 'day_1_before_dinner', 'day_1_2_hours_after_dinner', 'day_1_bed_time', 'day_1_at_3_am',
    
    'day_2_before_breakfast', 'day_2_2_hours_after_breakfast', 'day_2_before_lunch', 'day_2_2_hours_after_lunch', 'day_2_before_dinner', 'day_2_2_hours_after_dinner', 'day_2_bed_time', 'day_2_at_3_am', 

    'day_3_before_breakfast', 'day_3_2_hours_after_breakfast', 'day_3_before_lunch', 'day_3_2_hours_after_lunch', 'day_3_before_dinner', 'day_3_2_hours_after_dinner', 'day_3_bed_time', 'day_3_at_3_am', 
    
    'day_4_before_breakfast', 'day_4_2_hours_after_breakfast', 'day_4_before_lunch', 'day_4_2_hours_after_lunch', 'day_4_before_dinner', 'day_4_2_hours_after_dinner', 'day_4_bed_time', 'day_4_at_3_am', 

    'day_5_before_breakfast', 'day_5_2_hours_after_breakfast', 'day_5_before_lunch', 'day_5_2_hours_after_lunch', 'day_5_before_dinner', 'day_5_2_hours_after_dinner', 'day_5_bed_time', 'day_5_at_3_am', 
    
    'day_6_before_breakfast', 'day_6_2_hours_after_breakfast', 'day_6_before_lunch', 'day_6_2_hours_after_lunch', 'day_6_before_dinner', 'day_6_2_hours_after_dinner', 'day_6_bed_time', 'day_6_at_3_am', 
    
    'day_7_before_breakfast', 'day_7_2_hours_after_breakfast', 'day_7_before_lunch', 'day_7_2_hours_after_lunch', 'day_7_before_dinner', 'day_7_2_hours_after_dinner', 'day_7_bed_time', 'day_7_at_3_am'];
}
