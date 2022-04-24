<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CeiAnalysisController extends Controller
{
    public function kobocei_analysis()
    {

        return view('backend.cei_analysis.kobocei_analysis')->with([]);

    }
}
