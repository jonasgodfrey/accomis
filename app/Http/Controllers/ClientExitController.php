<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use Illuminate\Http\Request;
use App\Models\ClientExitQuestionare;
use App\Models\HealthFacility;
use App\Models\Spo;
use App\Models\Cei;
use App\Models\Lgas;
use App\Models\States;
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

        $collection = '';

        // $responsex = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get('https://kobo.humanitarianresponse.info/assets/aweG5RNYvHNj7TMM2xHvxL/submissions/?format=json');

        // $kobos =  $responsex->object();

        // return $kobos;

        // $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get('https://kobo.humanitarianresponse.info/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json');

        //     $collection = json_decode($collection->getBody(true)->getContents());



        //     foreach ($collection as $key => $row){
        //         // dd($collection);

        //         $record  = Cei::insertOrIgnore([
        //            "recordid" => $row->_id,
        //            "start" => $row->start,
        //            "end" => $row->end,
        //            "today" => $row->today,
        //            "state" => $row->state,
        //            "lga" => $row->lga,
        //            "cbo" => $row->cbo,
        //            "cboemail"=> $row->cboemail,
        //            "ward" =>isset($row->ward)? $row->ward:'',
        //            "hf" => $row->hf,
        //            "qtr" => $row->qtr,
        //            "resp_name" => isset($row->resp_name)? $row->resp_name:'',
        //            "child_name" => isset($row->child_name)? $row->child_name:'',
        //            "resp_cat" => isset($row->resp_cat)? $row->resp_cat:'',
        //            "address" => isset($row->address)? $row->address:'',
        //            "phone" => isset($row->phone)? $row->phone:'',
        //            "occupation" => isset($row->occupation)? $row->occupation:'',
        //            "other_occupation" => isset($row->other_occupation)? $row->other_occupation:'',
        //            "resp_edu" => isset($row->resp_edu)? $row->resp_edu:'',
        //            "created_at" => isset($row->created_at)? $row->created_at:'',
        //            "updated_at" => isset($row->updated_at)? $row->updated_at:'',
        //            "other_edu" => isset($row->other_edu)? $row->other_edu:'',
        //            "service_cat" => isset($row->service_cat)? $row->service_cat:'',
        //            "serv_received" => isset($row->serv_received)? $row->serv_received:'',
        //            "other_received" => isset($row->other_received)? $row->other_received:'',
        //            "freq_visit" => isset($row->freq_visit)? $row->freq_visit:'',
        //            "llin_recipient" => isset($row->llin_recipient)? $row->llin_recipient:'',
        //            "llin_where" => isset($row->llin_where)? $row->llin_where:'',
        //            "where_others" => isset($row->where_others)? $row->where_others:'',
        //            "llin_where" => isset($row->llin_where)? $row->llin_where:'',
        //            "llin_freq" => isset($row->llin_freq)? $row->llin_freq:'',
        //            "llin_freq" => isset($row->llin_freq)? $row->llin_freq:'',
        //            "llin_sleep" => isset($row->llin_sleep)? $row->llin_sleep:'',
        //            "sleep_often" => isset($row->sleep_often)? $row->sleep_often:'',
        //            "why_no" => isset($row->why_no)? $row->why_no:'',
        //            "ipt_recipient" => isset($row->ipt_recipient)? $row->ipt_recipient:'',
        //            "freq_ipt" => isset($row->freq_ipt)? $row->freq_ipt:'',
        //            "sp_recipient" => isset($row->sp_recipient)? $row->sp_recipient:'',
        //            "given_sp" => isset($row->given_sp)? $row->given_sp:'',
        //            "sp_no" => isset($row->sp_no)? $row->sp_no:'',
        //            "why_others" => isset($row->why_others)? $row->why_others:'',
        //            "smc_recipient" => isset($row->smc_recipient)? $row->smc_recipient:'',
        //            "smc_age" => isset($row->smc_age)? $row->smc_age:'',
        //            "malaria" => isset($row->malaria)? $row->malaria:'',
        //            "tested_when" => isset($row->tested_when)? $row->tested_when:'',
        //            "act_recipient" => isset($row->act_recipient)? $row->act_recipient:'',
        //            "drug_received" => isset($row->drug_received)? $row->drug_received:'',
        //            "act_finish" => isset($row->act_finish)? $row->act_finish:'',
        //            "drug_finish_no" => isset($row->drug_finish_no)? $row->drug_finish_no:'',
        //            "rating" => isset($row->rating)? $row->rating:'',
        //            "dissatisfied" => isset($row->dissatisfied)? $row->dissatisfied:'',
        //            "others" => isset($row->others)? $row->others:'',
        //            "satisfied" => isset($row->satisfied)? $row->satisfied:'',
        //            "suggestion" => isset($row->suggestion)? $row->suggestion:'',
        //            "upload_image" => isset($row->upload_image)? $row->upload_image:'',
        //            "store_gps" => isset($row->store_gps)? $row->store_gps:'',

        //    ]);
        // }


        $page_views = request()->page_views;

        // dd($page_views??100);

        if (Gate::denies('admin_spo_cbo_me')) {
            abort('404');
        }
        $user = Auth::user();
        $spouser = Spo::where('email',  $user->email)->get();
        $state = "";
        $cboemail = "";
        foreach ($spouser as $spo_detail) {
            $state = $spo_detail->state;
        }

        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $clients = "";

        if ($role == "Cbo") {
            $clients = ClientExitQuestionare::where('auth_user_email', $user->email)->get()->sortDesc();
            $kobocei = Cei::where('cboemail', $user->email)->get()->sortDesc();
        }
        if ($role == "Admin") {
            // $clients = ClientExitQuestionare::all()->sortDesc();
            $clients = ClientExitQuestionare::latest()->paginate($page_views);
            $kobocei = Cei::latest();
        }
        if ($role == "Me") {
            // $clients = ClientExitQuestionare::all()->sortDesc();
            $clients = ClientExitQuestionare::latest()->paginate($page_views);
            $kobocei = Cei::latest();
        }
        if ($role == "Spo") {
            $state = substr($state, 0, strpos($state, ' '));
            $clients = ClientExitQuestionare::where('state', $state)->get()->sortDesc();
            $kobocei = Cei::where('state', $state)->get();
        }

        $health_facilities = HealthFacility::where('CBO_Email', $user->email)->get();

        return view('backend.clientexit.clientexit')->with([
            'clients' => $clients,
            'health_facilities' => $health_facilities,
            'collection' => $collection,
            'kobocei' => $kobocei
        ]);
    }

    public function view_more($id)
    {
        $client = ClientExitQuestionare::where('id', $id)->get();
        return view('backend.clientexit.view_more')->with([
            'clientexit' => $client,
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
            'cbo_name' => $cbo_name,
            'spo' => $spo_email,
            'state' => $state,
            'month' => $month,
            'year' => $year,
            'day' => $request->date,
            'quarter' => $request->quarter,
            'attachment' => $filename,
        ]);
    }

    public function cei_analysis_index()
    {
        $state = States::all();
        $ceis = [];
        return view('backend.cei_analysis.cei_analysis')->with([
            'states' => $state,
            'ceis' => $ceis,
        ]);
    }

    public function cei_analysis_table(Request $request)
    {
        $whereCondition = [
 
            ['state', '=', $request->state],
            ['cbo_name', '=', $request->cbo],
            ['quarter', '>=', $request->quarter],
         
        ];
        $state = States::all();
         
        $client_exit = ClientExitQuestionare::where($whereCondition)->get();

        return view('backend.cei_analysis.cei_analysis')->with([
            'states' => $state,
            'ceis' => $client_exit,
        ]);
    }

    public function cei_analysis_fetch(Request $request)
    {
        $cbo = Cbo::where('state', $request->value)->get();

        return response()->json($cbo);
    }

    public function multiple_delete(Request $request)
    {
        $ids = $request->ids;
        $files = ClientExitQuestionare::whereIn('id', $ids)->get();

        foreach ($files as $record) {

            if (Storage::delete("public/attachments/" . $record->attachment)) {
                $id = $record->id;
                ClientExitQuestionare::where('id', $id)->delete();
            } 
        }

        return response('Records deleted successfully');
    }
    
    public function delete($id)
    {
        $files = ClientExitQuestionare::where('id', $id)->get();

        foreach ($files as $file) {
            if (Storage::delete("public/attachments/" . $file->attachment)) {
                ClientExitQuestionare::where('id', $id)->delete();
                Session::flash('flash_message', 'Client Exit Report Deleted successfully');
            } else {
                Session::flash('error_message', 'Sorry an error occured, try again later !');
            }
            return redirect()->back();
        }
    }
}
