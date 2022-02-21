<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use Illuminate\Http\Request;
use App\Models\ClientExitQuestionare;
use App\Models\HealthFacility;
use App\Models\Spo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class ClientExitController extends Controller
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



    public function client_exit()
    {
        

        $responsex = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get('https://kobo.humanitarianresponse.info/assets/aweG5RNYvHNj7TMM2xHvxL/submissions/?format=json');

        $kobos =  $responsex->object();

        // return $kobos;

        
        $page_views = request()->page_views;

        // dd($page_views??100);

        if (Gate::denies('admin_spo_cbo_me')) {
            abort('404');
        }
        $user = Auth::user();
        $spouser = Spo::where('email',  $user->email)->get();
        $state = "";
        foreach ($spouser as $spo_detail) {
            $state = $spo_detail->state;
        }

        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $clients = "";

        if ($role == "Cbo") {
            $clients = ClientExitQuestionare::where('auth_user_email', $user->email)->get()->sortDesc();
        }
        if ($role == "Admin") {
            // $clients = ClientExitQuestionare::all()->sortDesc();
            $clients = ClientExitQuestionare::latest()->paginate($page_views);
        }
        if ($role == "Me") {
            // $clients = ClientExitQuestionare::all()->sortDesc();
            $clients = ClientExitQuestionare::latest()->paginate($page_views);
        }
        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $clients = ClientExitQuestionare::where('state', $state)->get()->sortDesc();
            // $clients = ClientExitQuestionare::where('state', $state)->latest()->paginate($page_views);
        }

        $health_facilities = HealthFacility::where('CBO_Email', $user->email)->get();
        return view('backend.clientexit.clientexit')->with([
            'clients' => $clients,
            'health_facilities'=> $health_facilities,
            'kobos' => $kobos
        ]);
    }

    public function client_exit_add(Request $request)
    {

        $month = date('M');
        $day = date('d');
        $year = date('Y');
        $user = Auth::user();
        $state = '';
        $spo_email = '';
        $email = $user->email;
        $cbo_name = $user->name;

        $cbo = DB::table('cbos')->where('email', $email)
            ->get();

        //loop for parsing fetched authenticated user's data
        foreach ($cbo as $cbo_detail) {
            $state = $cbo_detail->state;
        }

        $spo = DB::table('spos')->where('state', 'LIKE', "%{$state}%")->get();

        foreach ($spo as $spo_detail) {
            $spo_email = $spo_detail->email;
        }

        $file = $request->file('file');

        $filename = 'attached-file-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $file->storeAs('public/attachments', $filename);


        $submit_client_form = ClientExitQuestionare::create([
            'respondant_name' => $request->res_name,
            'child_name' => $request->child_name,
            'respondant_category' => $request->res_category,
            'respondant_address' => $request->address,
            'respondant_number' => $request->phone_no,
            'health_facility_of_interview' => $request->health_facility_of_interview,
            'respondant_occupation' => $request->occupation,
            'respondant_education' => $request->educational_bg,
            'purpose_of_comming' => $request->what_did_you_come_for,
            'treatment_received' => $request->what_treatment_did_you_recieve,
            'frequency_of_visit_3months' => $request->frequency_of_visit,
            'llin_reception' => $request->recieve_llin,
            'llin_reception_location' => $request->llin_recieve_location,
            'sleep_in_llin' => $request->sleep_in_llin,
            'sleep_in_llin_interval' => $request->sleep_in_llin_interval,
            'reason_for_not_sleeping_in_llin' => $request->reason_for_not_sleeping_in_llin,
            'frequency_of_llin_reception' => $request->llin_frequency,
            'ipt_reception' => $request->recieve_ipt,
            'frequency_of_ipt_reception' => $request->ipt_frequency,
            'sulfadoxin_pyrimethamine_intake' => $request->swallow_sp_sulfadoxin,
            'sulfadoxin_nonintake_reasons' => $request->services,
            'child_smc_reception' => $request->smc,
            'child_smc_reception_age' => $request->smc_reception_age,
            'malaria_test' => $request->malaria_test,
            'malaria_test_reason' => $request->malaria_reason,
            'malaria_test_period' => $request->malaria_test_period,
            'abc_therapy_reception' => $request->arthemisinin_based_therapy,
            'recieved_medication' => $request->arthemisinin_therapy_false,
            'medication_completion_status' => $request->arthemisinin_drug_finish,
            'abc_input_details' => $request->abc_input_details,
            'service_satisfaction_level' => $request->satisfaction_level,
            'service_satisfaction_level_reason' => $request->insatisfaction_cause,
            'service_satisfaction_aid' => $request->customer_help,
            'facility_improvment_suggestion' => $request->customer_help_improve,
            'auth_user_email' => $user->email,
            'cbo_name'=> $cbo_name,
            'spo' => $spo_email,
            'state' => $state,
            'month' => $month,
            'year' => $year,
            'day' => $request->date,
            'quarter' => $request->quarter,
            'attachment' => $filename,
        ]);
    }
    public function delete($id)
    {
        $files = ClientExitQuestionare::where('id', $id)->get();

        foreach ($files as $file) {
            if (Storage::delete("public/attachments/".$file->attachment)) {
                ClientExitQuestionare::where('id', $id)->delete();
                Session::flash('flash_message', 'Client Exit Report Deleted successfully');
                return redirect()->back();
            }else{
                Session::flash('error_message', 'Sorry an error occured, try again later !');
                return redirect()->back();
            }
        }

    }

   
}
 