<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;


class CatController extends Controller
{
    public function add_cat(Request $request)
    {

        $submit_cat = Cat::create([
            'cbo_name' => $request->cbo_name,
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state,
            'lga' => $request->lga,
            'phone' => $request->tel,
        ]);


        if ($submit_cat) {
            Session::flash('flash_message', 'Cat Added Successfully');
            return redirect(route('cbo'));
        }
    }


}
