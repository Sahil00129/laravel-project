<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampledownloadController extends Controller
{
    public function sampleMaster()
    {
      
        $path = public_path('sample/masters.xlsx');
        return response()->download($path);
        
    }

    public function sampleOpening()
    {
      
        $path = public_path('sample/opening_reading.xlsx');
        return response()->download($path);
        
    }

    public function sampleCurrent()
    {
      
        $path = public_path('sample/current_reading.xlsx');
        return response()->download($path);
        
    }
}
