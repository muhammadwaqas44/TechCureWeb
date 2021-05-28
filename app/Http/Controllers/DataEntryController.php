<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Excel;
use App\Models\Medication;
use App\Imports\MedicationsImport;

class DataEntryController extends Controller
{

    public function index(){
        return view('insertData');
    }

    public function importExcel(Request $request)
    {


        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();

        Excel::import(new MedicationsImport, $path);
        
        return "success";


    }
}
