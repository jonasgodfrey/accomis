<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fgdreport;
use App\Models\States;
use App\Models\Cbo;
use App\Models\Lgas;
use Illuminate\Support\Facades\Session;
use App\Models\CboMonthly;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Spo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class FgdreportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //
    public function fgdreports(){
        echo"This is where to update the fgd code";
    }
}
