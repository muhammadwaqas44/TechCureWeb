<?php

namespace App\Imports;

use App\Models\Medication;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;


class MedicationsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(!empty($row[4])){
            return new Medication([
                'title'     => $row[4],
                'slug' => Str::slug($row[4], '-'),
            ]);
        }
    }
}
