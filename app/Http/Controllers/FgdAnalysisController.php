<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FgdAnalysisController extends Controller
{
    public function otherreportsquarterly()
    {
        return view('backend.fgd.otherreports')->with([]);
    }


}
