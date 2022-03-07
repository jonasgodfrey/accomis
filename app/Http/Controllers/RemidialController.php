<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use App\Models\Spo;
use Illuminate\Http\Request;
use App\Models\Remedial;
use App\Models\States;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RemidialController extends Controller
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

    public function remidial()
    {
        if (Gate::denies('admin_spo_cbo_me')) {
            abort('404');
        }

        $user = Auth::user();
        $cbo = Cbo::where('email', $user->email)->get();
        $states = States::where('status', 'active')->get();

        $cbo_state = '';
        $cbo_lga = '';
        $cbo_name = '';

        //loop for parsing fetched authenticated user's data
        foreach($cbo as $cbo_detail){
            $cbo_name = $cbo_detail->cbo_name;
            $cbo_state = $cbo_detail->state;
            $cbo_lga = $cbo_detail->lga;
        }

        $spouser = Spo::where('email',  $user->email)->get();
        $state = "";
        foreach ($spouser as $spo_detail) {
            $state = $spo_detail->state;
        }

        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $rem = "";

        if ($role == "Cbo") {
            $rem = Remedial::where('cbo', $user->email)->get()->sortDesc();
        }
        if ($role == "Admin") {
            $rem = Remedial::all()->sortDesc();
        }
        if ($role == "Me") {
            $rem = Remedial::all()->sortDesc();
        }

        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $rem = Remedial::where('state', $state)->get()->sortDesc();
        }

        $wards = Ward::where('lga', $cbo_lga)->get();

        return view('backend.remidial.remidialfeedback')->with([
            'rems' => $rem,
            'states' => $states,
            'cbo_state' => $cbo_state,
            'cbo_lga' => $cbo_lga,
            'cbo_name' => $cbo_name,
            'wards' => $wards,
        ]);
    }

    public function add_remidial(Request $request)
    {
        $file = $request->signed_doc;

        $signed_doc = 'attached-file-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $file->storeAs('public/remedial', $signed_doc);

        $month = date('M');
        $year = date('Y');
        $user = Auth::user();
        $cbo = $user->email;
        $cbo_name = $user->name;
        $ward = "";

        if($request->ward == ""){
            $ward = 'not available';
        }

        $issues = implode(', ', $request->input('key_findings'));


        $add_remidial = Remedial::create([
            'state' => $request->state,
            'ward' => $ward,
            'cbo' => $cbo,
            'date_visit' => $request->date_visit,
            'tracker_type' => $request->tracker_type,
            'identified_issues' => $issues,
            'root_cause' => $request->root_cause,
            'action_taken_immediately' => $request->taken_action,
            'resolved' => $request->resolved_value,
            'follow_up_action' => $request->follow_action,
            'responsibility' => $request->responsibility,
            'timeline' => $request->timeline,
            'signed_document' => $signed_doc,
            'month' => $month,
            'year' => $year,
            'quarter' => $request->quarter,
            'cbo_name'=> $cbo_name,
        ]);


        if ($add_remidial) {
            Session::flash('flash_message', 'Remedial Report Added Successfully');
            return redirect(route('remidial'));
        }
    }

    public function multiple_delete(Request $request)
    {

        $ids = $request->ids;
        $files = Remedial::whereIn('id', $ids)->get();

        foreach ($files as $record) {

            $id = $record->id;
            
            if (Storage::delete("public/remedial/". $record->signed_document)) {
                Remedial::where('id', $id)->delete();
            }
        }

        return response('Records deleted successfully');
    }

    public function delete($id)
    {
        $files = Remedial::where('id', $id)->get();

        foreach ($files as $file) {
            if (Storage::delete("public/remedial/".$file->signed_document)) {
                Remedial::where('id', $id)->delete();
                Session::flash('flash_message', 'Remedial Report Deleted successfully');
                return redirect()->back();
            }else{
                Session::flash('error_message', 'Sorry an error occured, try again later !');
                return redirect()->back();
            }
        }

    }
}
