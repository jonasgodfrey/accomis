<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;
use App\Models\Ward;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class WardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::denies('admin_role')) {
            abort('404');
        }

        $wards = Ward::where('status', 'active')->get()->sortDesc();
        $states = States::where('status', 'active')->get();
        return view('backend.wards.wards')->with([
            'states' => $states,
            'wards' => $wards,
        ]);
    }

    public function add_ward(Request $request)
    {
        $ward = Ward::create([
            'ward_name'=> $request->ward_name,
            'lga'=> $request->lga,
            'state'=> $request->state,
            'status'=> 'active',

        ]);
        if ($ward) {
            Session::flash('flash_message', 'Ward Added Successfully');
            return redirect(route('wards.view'));
        }
    }
}
