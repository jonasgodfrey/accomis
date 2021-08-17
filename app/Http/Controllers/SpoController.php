<?php

namespace App\Http\Controllers;

use App\Models\SpoMonthly;
use App\Models\States;
use App\Models\Lgas;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Spo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpoController extends Controller
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

    public function spo_index()
    {
        if (Gate::denies('admin_spo')) {
            abort('404');
        }

        $spos = Spo::all();
        $states = States::where('status', 'active')->get();

        return view('backend.spo.spo')->with([
            'states' => $states,
            'spos' => $spos,
        ]);
    }

    public function add_spo(Request $request)
    {
        $spoRole = Role::where('name', 'Spo')->first();

        if (User::where('email', '=', $request->email)->exists()) {
            Session::flash('error_message', 'A user with this email already exists!');
            return redirect(route('spo.monthly'));
        } else {
            // user email found
            $spo = User::create([
                'name' => $request->spo_name,
                'email' => $request->email,
                'password' => Hash::make($request->state),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $submit_cbo = Spo::create([
                'spo_name' => $request->spo_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'state' => $request->state,
                'physical_contact_address' => $request->address
            ]);
            $spo->roles()->attach($spoRole);

            if ($submit_cbo) {
                Session::flash('flash_message', 'Spo Added Successfully');
                return redirect(route('spo.monthly'));
            }
        }
    }

    public function spo_monthly()
    {
        if (Gate::denies('admin_spo_me')) {
            abort('404');
        }

        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spouser = Spo::where('email',  $user->email)->get();
        $state = "";
        $spo = "";

        foreach ($spouser as $spo_detail) {
            $state = $spo_detail->state;
        }

        if ($role == "Admin") {
            $spo = SpoMonthly::all();
        }
        if ($role == "Me") {
            $spo = SpoMonthly::all();
        }
        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $spo = SpoMonthly::where('state', $state)->get();
        }

        return view('backend.spo.spomonthly')->with([
            'spos' => $spo,
            'states' => $state,
        ]);
    }
    public function add_spomonthly(Request $request)
    {
        if (Gate::denies('admin_spo')) {
            abort('404');
        }

        $request->validate([
            'attachment' => 'required|mimes:pdf,docx,docs,docs|max:20048'
        ]);

        $file = $request->file('attachment');

        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = 'attached-file-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $file->storeAs('public/attachments', $filename);

        $month = date('M');
        $year = date('Y');

        $user = Auth::user();
        $spouser = Spo::where('email',  $user->email)->get();
        $name = "";

        foreach ($spouser as $spo_detail) {
            $name = $spo_detail->spo_name;
        }

         $submit_spo_monthly = SpoMonthly::create([
            'name' => $name,
            'state' => $request->state,
            'attachment' => $filename,
            'minutes_of_meeting' => $request->minutes,
            'date_of_meeting' => $request->meeting_date,
            'month' => $month,
            'year' => $year,
            'quarter' => $request->quarter,
        ]);

        if ($submit_spo_monthly) {
            Session::flash('flash_message', 'Spo Monthly Report Added Successfully');
            return redirect(route('spo_add_monthly'));
        }
    }

    public function spo_add(Request $request)
    {
        if (Gate::denies('admin_spo')) {
            abort('404');
        }
    }
}
