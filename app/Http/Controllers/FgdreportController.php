<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Fgdreport;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        //initiating classes and assinging it to a variable
        $user = Auth::user();
        $spouser = Spo::where('email', $user->email)->first();




        $state1 = $spouser->state??'';

        $state = $spouser->state??'';

        // dd($state1);

        //fetching spo state and assigning to the state variable
        // foreach ($spouser as $spo_detail) {
        //     $state = $spo_detail->state;
        // }

        //getting the role of the current auth user and assigning it
        $role = implode(' ', $user->roles->pluck('name')->toArray());

        //cbo var initiation
        $cbo = "";

        //conditions for checking the user role and assigning the respective data for that user to view to the cbo var
        if ($role == "Cbo") {
            $cbo = CboMonthly::where('cbo_name', $user->name)->get();
        }
        if ($role == "Admin") {
            $cbo = CboMonthly::all();
        }
        if ($role == "Me") {
            $cbo = CboMonthly::all();
        }
        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $cbo = CboMonthly::where('state', $state)->get();

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
        $fgds = '';

        if ($role == "Cbo") {
            $cbo = Fgdreport::where('email', $user->email)->get();
        }
        if ($role == "Admin") {
            $cbo = Fgdreport::all()->sortDesc();
        }
        if ($role == "Me") {
            $cbo = Fgdreport::all()->sortDesc();
        }
        if ($role == "Spo") {
            $state1 = substr($state, 0, strpos($state1, ' '));
            // $cbo = Fgdreport::where('state', $state)->get();
            $cbo = Fgdreport::where('state', $state1)->get()->sortDesc();

            // dd($cbo);

        }
        return view('backend.fgd.fgdreport')->with([
            'cbos' => $cbo,
            'states' => $states,
            'cbo_state' => $cbo_state,
            'cbo_lga' => $cbo_lga,
            'cbo_name' => $cbo_name,
            'fgds' => $fgds,
        ]);

    }

    public function add_fgd(Request $request)
    {

        $request->validate([
            'attachment' => 'required|mimes:pdf,docx,docs,doc,jpg,jpeg,img,gif,png,PNG|max:20048'
        ]);

        $user = Auth::user();
        $file = $request->file('attachment');

        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = '/fgd_files/attached-file-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $file->storeAs('public/attachments', $filename);
        $month = date('M');
        $year = date('Y');
        $submit_fgd = Fgdreport::create([
            'cbo_name' => $request->cbo_name,
            'state' => $request->state,
            'lga' => $request->lga,
            'email' => $user->email,
            'attachment' => $filename,
            'date_of_activity' => $request->meeting_date,
            'activity' => $request->activity,
            'month' => $month,
            'year' => $year,
            'quarter' => $request->quarter,
        ]);

        if ($submit_fgd) {
            Session::flash('flash_message', 'Activity Report Added Successfully');
            return redirect(route('fgdreport'));
        }
    }
    public function delete($id)
    {
        $files = Fgdreport::where('id', $id)->get();

        foreach ($files as $file) {
            if (Storage::delete("public/attachments/".$file->attachment)) {
                Fgdreport::where('id', $id)->delete();
                Session::flash('flash_message', 'Fgd Report Deleted successfully');
                return redirect()->back();
            }else{
                Session::flash('error_message', 'Sorry an error occured, try again later !');
                return redirect()->back();
            }
        }

    }
}
