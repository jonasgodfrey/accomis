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
use Illuminate\Support\Facades\DB;

class GeneralAnalysisController extends Controller
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
    public function genanalysis()
    {
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());

        if ($role == "Admin" || $role == "Me" ) {

            $states =  States::where('status', 'active')->get();
            $lgas =  count(Lgas::where('status', 'active')->get());
            $wards = count(Ward::where('status', 'active')->get());
            $health_facilities = count(HealthFacility::all());
            $spos = count(Spo::all());
            $cbos = count(Cbo::all());
            $cats = count(Cat::all());
            $remedial = count(Remedial::all());
            $client_exits = count(ClientExitQuestionare::all());
            $tested_malaria = count(ClientExitQuestionare::where('malaria_test', 'yes')->get());
            $llin_recipients = count(ClientExitQuestionare::where('llin_reception', 'yes')->get());
            $act_recipients = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->get());
            $ipt_recipients = count(ClientExitQuestionare::where('ipt_reception', 'yes')->get());
            $positive_malaria = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->get());
            $sp_recepients = count(ClientExitQuestionare::where('sulfadoxin_pyrimethamine_intake', 'yes')->get());
            $smc_recepients = count(ClientExitQuestionare::where('child_smc_reception', 'yes')->get());
            $pregnant_women = count(ClientExitQuestionare::where('respondant_category', 'Female Pregnant')->get());
            $issues_resolved = count(Remedial::where('resolved', 'Yes')->get());

            return view('backend.analysis.adminanalysis')->with([
                'states'=>$states,
                'lgas'=>$lgas,
                'wards'=>$wards,
                'health_facilities'=>$health_facilities,
                'spos'=>$spos,
                'cbos'=>$cbos,
                'cats'=>$cats,
                'client_exits'=>$client_exits,
                'tested_malaria'=>$tested_malaria ,
                'llin_recipients'=>$llin_recipients,
                'act_recipients'=>$act_recipients,
                'ipt_recipients'=>$ipt_recipients,
                'positive_malaria'=>$positive_malaria,
                'sp_recepients'=>$sp_recepients,
                'smc_recepients'=>$smc_recepients,
                'pregnant_women'=>$pregnant_women ,
                'remedial'=>$remedial,
                'issues_resolved'=>$issues_resolved,
            ]);
        }
    }

    public function fetchRecords(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');
        $lgas =  count(Lgas::where('status', 'active')->where('state_id', $value)->get());
        $wards = count(Ward::where('status', 'active')->where('state', $select)->get());
        $health_facilities = count(HealthFacility::where('State', $select)->get());
        $spos = count(Spo::where('state', 'LIKE', "%{$select}%")->get());
        $cbos = count(Cbo::where('state', $select)->get());
        $cats = count(Cat::where('state', $select)->get());
        $remidial = count(Remedial::where('state', $select)->get());
        $client_exits = count(ClientExitQuestionare::where('state', $select)->get());
        $tested_malaria = count(ClientExitQuestionare::where('malaria_test', 'yes')->where('state', $select)->get());
        $llin_recipients = count(ClientExitQuestionare::where('llin_reception', 'yes')->where('state', $select)->get());
        $act_recipients = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->where('state', $select)->get());
        $ipt_recipients = count(ClientExitQuestionare::where('ipt_reception', 'yes')->where('state', $select)->get());
        $positive_malaria = count(ClientExitQuestionare::where('abc_therapy_reception', 'yes')->where('state', $select)->get());
        $sp_recepients = count(ClientExitQuestionare::where('sulfadoxin_pyrimethamine_intake', 'yes')->where('state', $select)->get());
        $smc_recepients = count(ClientExitQuestionare::where('child_smc_reception', 'yes')->where('state', $select)->get());
        $pregnant_women = count(ClientExitQuestionare::where('respondant_category', 'Female Pregnant')->where('state', $select)->get());
        $issues_resolved = count(Remedial::where('resolved', 'Yes')->get());

        $json = [
            'lgas'=>$lgas,
            'wards'=>$wards,
            'health_facilities'=>$health_facilities,
            'spos'=>$spos,
            'cats'=>$cats,
            'cbos'=>$cbos,
            'remidial'=>$remidial,
            'client_exits'=>$client_exits,
            'tested_malaria'=>$tested_malaria,
            'llin_recipients'=>$llin_recipients,
            'act_recipients'=>$act_recipients,
            'ipt_recipients'=>$ipt_recipients,
            'positive_malaria'=>$positive_malaria,
            'sp_recepients'=>$sp_recepients ,
            'smc_recepients'=>$smc_recepients,
            'pregnant_women'=>$pregnant_women,          
            'issues_resolved'=>$issues_resolved
        ];

        return $json;
    }
}

