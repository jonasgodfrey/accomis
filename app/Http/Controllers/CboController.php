<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use App\Models\CboMonthly;
use App\Models\Role;
use App\Models\Spo;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CboController extends Controller
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

    //cbo view function for parsing data to cbo tables
    public function cbo_index()
    {
        if (Gate::denies('admin_spo_me')) {
            abort('404');
        }

        $cbo = Cbo::all();
        $states = States::where('status', 'active')->get();

        return view('backend.cbo.cbo')->with([
            'cbos' => $cbo,
            'states' => $states,
        ]);
    }

    //add cbo function
    public function add_cbo_view()
    {
        if (Gate::denies('admin_role')) {
            abort('404');
        }

        $cbo = Cbo::all();
        $states = States::where('status', 'active')->get();

        return view('backend.cbo.add_cbo')->with([
            'cbos' => $cbo,
            'states' => $states,
        ]);
    }

    //cbo monthly view function also parses cbo monthly view data to cbo monthly tables
    public function cbo_monthly()
    {
        //for checking the auth user roles
        if (Gate::denies('admin_spo_cbo_me')) {
            abort('404');
        }

        //initiating classes and assinging it to a variable
        $user = Auth::user();
        $spouser = Spo::where('email', $user->email)->get();
        $state = "";

        //fetching spo state and assigning to the state variable
        foreach ($spouser as $spo_detail) {
            $state = $spo_detail->state;
        }

        //getting the role of the current auth user and assigning it
        $role = implode(' ', $user->roles->pluck('name')->toArray());

        //cbo var initiation
        $cbo = "";

        //conditions for checking the user role and assigning the respective data for that user to view to the cbo var
        if ($role == "Cbo") {
            $cbo = CboMonthly::where('cbo_name', $user->name)->get()->sortDesc();
        }
        if ($role == "Admin") {
            $cbo = CboMonthly::all()->sortDesc();
        }
        if ($role == "Me") {
            $cbo = CboMonthly::all()->sortDesc();
        }
        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $cbo = CboMonthly::where('state', $state)->get()->sortDesc();

        }

        $cbo1 = Cbo::where('email', $user->email)->get();
        $cbo_state = '';
        $cbo_lga = '';
        $cbo_name = '';

        //loop for parsing fetched authenticated user's data
        foreach ($cbo1 as $cbo_detail) {
            $cbo_name = $cbo_detail->cbo_name;
            $cbo_state = $cbo_detail->state;
            $cbo_lga = $cbo_detail->lga;
        }

        $states = States::where('status', 'active')->get();

        return view('backend.cbo.cbomonthly')->with([
            'cbos' => $cbo,
            'states' => $states,
            'cbo_state' => $cbo_state,
            'cbo_lga' => $cbo_lga,
            'cbo_name' => $cbo_name,
        ]);
    }

    public function view_more($id)
    {      
        $cbo_monthly = CboMonthly::where('id', $id)->get();
        return view('backend.cbo.view_more')->with([
            'cbo_monthly' => $cbo_monthly,
        ]);
    }

    //add cbo function
    public function add_cbo(Request $request)
    {

        $cboRole = Role::where('name', 'Cbo')->first();
        if (User::where('email', '=', $request->email)->exists()) {
            Session::flash('error_message', 'A user with this email already exists!');
            return redirect(route('cbo.add.view'));

        } else {

            $cbo = User::create([
                'name' => $request->cbo_name,
                'email' => $request->email,
                'password' => Hash::make($request->state),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $submit_cbo = Cbo::create([
                'cbo_name' => $request->cbo_name,
                'email' => $request->email,
                'state' => $request->state,
                'lga' => $request->lga,
                'phone' => $request->phone,
                'contact_person' => $request->contact_person,
                'date_of_engagement' => $request->engage_date,
                'date_of_establishment' => $request->establish_date,
                'physical_contact_address' => $request->contact_address,
            ]);

            $cbo->roles()->attach($cboRole);

            if ($submit_cbo) {
                Session::flash('flash_message', 'Cbo Added Successfully');
                return redirect(route('cbo'));
            }
        }
    }

    public function add_cbo_monthly(Request $request)
    {

        $request->validate([
            'attachment' => 'required|mimes:pdf,docx,docs,doc|max:30048',
        ]);

        $file = $request->file('attachment');

        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = 'attached-file-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $file->storeAs('public/attachments', $filename);
        $month = date('M');
        $year = date('Y');
        $submit_cbo_monthly = CboMonthly::create([
            'cbo_name' => $request->cbo_name,
            'state' => $request->state,
            'lga' => $request->lga,
            'attachment' => $filename,
            'minutes_of_meeting' => $request->minutes,
            'date_of_meeting' => $request->meeting_date,
            'month' => $month,
            'year' => $year,
            'quarter' => $request->quarter,
        ]);

        if ($submit_cbo_monthly) {
            Session::flash('flash_message', 'Cbo Monthly Report Added Successfully');
            return redirect(route('cbo.monthly'));
        }
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $data = DB::table('lgas')->where('state_id', $value)->get();
        $output = '';
        foreach ($data as $row) {
            $output .=
            '<option class="' . $row->id . '" id="' . $row->name . '" value="' . $row->name . '">' . $row->name . '</option>
            ';
        }

        return $output;
    }

    public function cbo_fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent1');
        $data = DB::table('cbos')->where('lga', $value)
            ->get();

        $output = '';

        foreach ($data as $row) {

            $output .=
            '<option value="' . $row->cbo_name . '">' . $row->cbo_name . '</option>
        ';
        }

        echo $output;
    }

    public function multiple_delete(Request $request){
        $ids = $request->ids;
        $files = CboMonthly::whereIn('id', $ids)->get();

        foreach($files as $record){
           
            if (Storage::delete("public/attachments/".$record->attachment)) {
                $id = $record->id;
                CboMonthly::where('id', $id)->delete();
            }
        

        }
      
        return response('Records deleted successfully');

    }

    public function delete_cbo_monthly($id)
    {
        $files = CboMonthly::where('id', $id)->get();

        foreach ($files as $file) {
            if (Storage::delete("public/attachments/".$file->attachment)) {
                CboMonthly::where('id', $id)->delete();
                Session::flash('flash_message', 'Monthly Report Deleted successfully');
                return redirect()->back();
            }else{
                Session::flash('error_message', 'Sorry an error occured, try again later !');
                return redirect()->back();
            }
        }

    }

}
