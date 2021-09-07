<?php

namespace App\Http\Controllers;

use App\Models\HealthFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\States;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HealthFacilitiesController extends Controller
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

    public function health_facility()
    {
        if (Gate::denies('admin_me')) {
            abort('404');
        }

        $states = States::where('status', 'active')->get();
        $health_facilities = HealthFacility::all()->sortDesc();
        return view('backend.healthfacilities.healthfacilities')->with([
            'states' => $states,
            'health_facilities'=>$health_facilities
        ]);
    }


    public function health_facility_add(Request $request)
    {
       $health_facility = HealthFacility::create([
            'State' => $request->state,
            'Lga' => $request->lga,
            'Ward' => $request->ward,
            'Facility' => $request->facility,
            'CBO' => $request->cbo_name,
            'CBO_Email' => $request->cbo_email,
            'SPO' => $request->spo_name,
            'SPO_Email' => $request->spo_email,
            'status' => 'active',
       ]);

       if ($health_facility) {
        Session::flash('flash_message', 'Health Facility Added Successfully');
        return redirect(route('health_facility'));
        }
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $value2 = $request->value2;
        $dependent = $request->get('dependent');

        $data = DB::table('lgas')->where($select, $value)
            ->get();
        $spo_data = DB::table('spos')->where('state', 'LIKE', "%{$value2}%")
            ->get();

        $output = '';
        $spo_email = '';
        $spo_name = '';

        foreach ($data as $row) {
            $output .=
                '<option style="display:none">Select Lga</option>
                <option id="' . $row->name . '" value="' . $row->name . '">' .$row->name . '</option>
            ';
        }

        foreach ($spo_data as $spo) {
            $spo_email = $spo->email;
            $spo_name = $spo->spo_name;
        }


        $json = [
            'spo_name' => $spo_name,
            'spo_email' => $spo_email,
            'lga' => $output
        ];

        return $json;
    }

    public function cbo_fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent1');
        $data = DB::table('cbos')->where('lga', $value)
            ->get();

        $data2 = DB::table('wards')->where('lga', $value)
            ->get();

        $output = '';

        $ward = '';

        foreach ($data2 as $row2) {

            $ward .=
                '<option style="display:none">Select Ward</option>
                <option id="' . $row2->id . '" value="' . $row2->ward_name . '">' . $row2->ward_name . '</option>
        ';
        }

        foreach ($data as $row) {

            $output .=
                '<option>Select Cbo</option>
                <option id="' . $row->id . '" value="' . $row->cbo_name . '">' . $row->cbo_name . '</option>
        ';
        }


        $json = [
            'ward' => $ward,
            'cbo' => $output
        ];

        return $json;
    }

    public function cbo_info(Request $request)
    {
        $value = $request->get('value');

        $data = DB::table('cbos')->where('id', $value)
            ->get();

        $name = '';

        foreach ($data as $row) {
            $name = $row->email;
        }

        echo $name;
    }
}
