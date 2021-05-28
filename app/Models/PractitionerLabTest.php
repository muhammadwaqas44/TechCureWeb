<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerLabTest extends Model
{
    protected $fillable = ['practitioner_id', 'lab_test_id'];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id');
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id');
    }
}
