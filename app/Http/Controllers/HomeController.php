<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Lgas;
use App\Models\States;
use App\Models\ClientExitQuestionare;
use App\Models\Cat;
use App\Models\Cbo;
use App\Models\Ward;
use App\Models\HealthFacility;
use App\Models\Remedial;
use App\Models\Spo;
use App\Models\Cei;
use DB;

class HomeController extends Controller
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
    public function index()
    {
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spo = '';

        if ($role == "Admin"  || $role == "Me") {

            $states =  count(States::where('status', 'active')->get());
            $lgas =  count(Lgas::where('status', 'active')->get());
            $wards = count(Ward::where('status', 'active')->get());
            $health_facilities = count(HealthFacility::all());
            $spos = count(Spo::all());
            $cbos = count(Cbo::all());
            $cats = count(Cat::all());
            $remedial = count(Remedial::all());
            $client_exits = count(ClientExitQuestionare::all());
            $kobocei = count(Cei::all());
            $tested_malaria = count(ClientExitQuestionare::where('malaria_test', 'yes')->get());
            $llin_recipients = count(ClientExitQuestionare::where('llin_reception', 'yes')->get());
            $act_recipients = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->get());
            $ipt_recipients = count(ClientExitQuestionare::where('ipt_reception', 'yes')->get());
            $positive_malaria = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes' && 'respondent_category', 'Female Pregnant')->get());
            $sp_recepients = count(ClientExitQuestionare::where('sulfadoxin_pyrimethamine_intake', 'yes')->get());
            $smc_recepients = count(ClientExitQuestionare::where('child_smc_reception', 'yes')->get());
            $pregnant_women = count(ClientExitQuestionare::where('respondant_category', 'Female Pregnant')->get());
            $malaria_service = count(ClientExitQuestionare::where('purpose_of_comming', 'Malaria Services')->get());
            $antenatal_service = count(ClientExitQuestionare::where('purpose_of_comming', 'Antenatal Care')->get());
            $maternal_service = count(ClientExitQuestionare::where('purpose_of_comming', 'Maternal and Newborn Care')->get());
            $maternal_treatment = count(ClientExitQuestionare::where('treatment_received', 'Maternal and Newborn Care')->get());
            $antenatal_treatment = count(ClientExitQuestionare::where('treatment_received', 'Antenatal Care')->get());
            $malaria_treatment = count(ClientExitQuestionare::where('treatment_received', 'Malaria')->get());
            $issues_resolved = count(Remedial::where('resolved', 'Yes')->get());
            $issues_unresolved = count(Remedial::where('resolved', 'No')->get());
            $entryfgd = count(Remedial::where('tracker_type', 'Client Exit')->get());
            $exitfgd = count(Remedial::where('tracker_type', 'Exit FGD')->get());
            $kii = count(Remedial::where('tracker_type', 'KII')->get());
            $patronage = count(Remedial::where('identified_issues', '[Low Patronage]')->get());
            
            $kobollin = Cei::where('llin_recipient','Yes')->count();
            $koboact = Cei::where('act_recipient','Yes')->count();
            $kobosp = Cei::where('sp_recipient','Yes')->count();
            $kobosmc = Cei::where('smc_recipient','Yes')->count();
            $kobomalaria = Cei::where('malaria','Yes')->count();
            $kobomalserv = Cei::where('service_cat','Malaria Services')->count();                  
            $koboantenatalserv = Cei::where('service_cat','Antenatal Care')->count();
            $kobonewborncare = Cei::where('service_cat','Maternal and Newborn Care')->count();

            return view('backend.dashboards.admin_dashboard')->with([
                'states'=>$states,
                'lgas'=>$lgas,
                'wards'=>$wards,
                'health_facilities'=>$health_facilities,
                'spos'=>$spos,
                'cbos'=>$cbos,
                'cats'=>$cats,
                'client_exits'=>$client_exits,
                'kobocei'=>$kobocei,
                'tested_malaria'=>$tested_malaria ,
                'llin_recipients'=>$llin_recipients,
                'act_recipients'=>$act_recipients,
                'ipt_recipients'=>$ipt_recipients,
                'positive_malaria'=>$positive_malaria,
                'sp_recepients'=>$sp_recepients,
                'smc_recepients'=>$smc_recepients,
                'pregnant_women'=>$pregnant_women ,
                'remedial'=>$remedial,
                'kii'=>$kii,
                'exitfgd'=>$exitfgd,
                'entryfgd'=>$entryfgd,
                'issues_resolved'=>$issues_resolved,
                'issues_unresolved'=>$issues_unresolved,
                'maternal_service'=>$maternal_service,
                'antenatal_service'=>$antenatal_service,
                'malaria_service'=>$malaria_service,
                'maternal_treatment'=>$maternal_treatment,
                'antenatal_treatment'=>$antenatal_treatment,
                'malaria_treatment'=>$malaria_treatment,
                'issues_identified'=>$patronage,

                'kobollin_recipient'=>$kobollin,
                'koboact_recipient'=>$koboact,
                'kobosp_recipient'=>$kobosp,
                'kobosmc_recipient'=>$kobosmc,
                'kobomalariatest'=>$kobomalaria,
                'kobomalaria_service'=>$kobomalserv,
                'koboantenatal_service'=>$koboantenatalserv,
                'kobonewborn_service'=>$kobonewborncare

                
            ]);
        }

        if ($role == "Cbo") {

            $health_facilities = count(HealthFacility::where('CBO_Email', $user->email)->get());
            $client_exits = count(ClientExitQuestionare::where('auth_user_email', $user->email)->get());
            $kobocei = count(Cei::where('cboemail', $user->email)->get());
            $remidial = count(Remedial::where('cbo', $user->email)->get());

            return view('backend.dashboards.cbo_dashboard')->with([
                'health_facilities'=>$health_facilities,
                'client_exits'=>$client_exits,
                'kobocei'=>$kobocei,
                'remidial'=>$remidial,
                'username'=> $user->name,
            ]);
        }

        if ($role == "Spo") {

            $spo_data = DB::table('spos')->where('email', $user->email)
                ->get();
             
            $state = '';
            $spo_email = '';
            $spo_name = '';

            foreach ($spo_data as $spo) { 
                $spo_email = $spo->email;
                $spo_name = $spo->spo_name;
                $state = $spo->state;
            }
            $state = substr($state, 0, strpos($state, ' '));    

            // $lgas =  count(Lgas::where('status', 'active')->where('state', 'LIKE', "%{$state}%")->get());
            $wards = count(Ward::where('status', 'active')->where('state', 'LIKE', "%{$state}%")->get());
            $health_facilities = count(HealthFacility::where('state', 'LIKE', "%{$state}%")->get());
            $cbos = count(Cbo::where('state', 'LIKE', "%{$state}%")->get());
            $client_exits = count(ClientExitQuestionare::where('state', 'LIKE', "%{$state}%")->get());
            $kobocei = count(Cei::where('state', 'LIKE', "%{$state}%")->get());
            $tested_malaria = count(ClientExitQuestionare::where('malaria_test', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $llin_recipients = count(ClientExitQuestionare::where('llin_reception', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $act_recipients = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $ipt_recipients = count(ClientExitQuestionare::where('ipt_reception', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $positive_malaria = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $sp_recepients = count(ClientExitQuestionare::where('sulfadoxin_pyrimethamine_intake', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $smc_recepients = count(ClientExitQuestionare::where('child_smc_reception', 'yes')->where('state', 'LIKE', "%{$state}%")->get());
            $maternal = count(ClientExitQuestionare::where('purpose_of_comming', 'Maternal and Newborn Care')->where('state', 'LIKE', "%{$state}%")->get());
            $pregnant_women = count(ClientExitQuestionare::where('respondant_category', 'Female Pregnant')->where('state', 'LIKE', "%{$state}%")->get());
            $issues_identified = count(Remedial::where('state', 'LIKE', "%{$state}%")->get());
            $issues_resolved = count(Remedial::where('resolved',     'Yes')->where('state', 'LIKE', "%{$state}%")->get());
            $entryfgd = count(Remedial::where('tracker_type', 'Client Exit')->where('state', 'LIKE', "%{$state}%")->get());
            $exitfgd = count(Remedial::where('tracker_type', 'Exit FGD')->where('state', 'LIKE', "%{$state}%")->get());
            $kii = count(Remedial::where('tracker_type', 'KII')->where('state', 'LIKE', "%{$state}%")->get());



            return view('backend.dashboards.spo_dashboard')->with([
                'wards'=>$wards,
                'health_facilities'=>$health_facilities,
                'cbos'=>$cbos,
                'client_exits'=>$client_exits,
                // Start Kobocei Data
                'kobocei'=>$kobocei,
                
                // end
                'tested_malaria'=>$tested_malaria ,
                'llin_recipients'=>$llin_recipients,
                'act_recipients'=>$act_recipients,
                'ipt_recipients'=>$ipt_recipients,
                'positive_malaria'=>$positive_malaria,
                'sp_recepients'=>$sp_recepients,
                'smc_recepients'=>$smc_recepients,
                'pregnant_women'=>$pregnant_women ,
                'issues_resolved'=>$issues_resolved,
                'issues_identified'=>$issues_identified,
                'username'=> $user->name,
                'state'=>$state,
  
            ]);
        }
    }
}
