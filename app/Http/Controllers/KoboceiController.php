<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\Models\Cei; 

use Illuminate\Support\Facades\DB;

class KoboceiController extends Controller
{
    
        //
        function fetchdata(){
            $data= Cei::all();
            return view('backend.clientexit.clientexit',['ceis'=>$data]); 
        }
    
}
