<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;
use App\Models\ClientExitQuestionare;
use App\Models\Cei;
use Illuminate\Support\Facades\Auth;
use App\Models\Spo;
use App\Models\Cbo;
use COM;

class CeiAnalysisController extends Controller
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


    public function cei_analysis_index()
    {
        $state = States::all();
        $ceis = [];
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spouser = Spo::where('email',  $user->email)->get();


        if ($role == "Spo") {

            foreach ($spouser as $spo_detail) {
                $state = $spo_detail->state;
                $state_name = substr($state, 0, strpos($state, ' '));
                $state = States::where('name', $state_name)->get();
            }

            return view('backend.cei_analysis.cei_analysis')->with([
                'state' => $state,
                'states' => [],
                'ceis' => $ceis,
            ]);
        } else {

            return view('backend.cei_analysis.cei_analysis')->with([
                'states' => $state,
                'state' => [],
                'ceis' => $ceis,
            ]);
        }
    }

    public function cei_analysis_table(Request $request)
    {

        $state = States::all();
        $client_exit = [];
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spouser = Spo::where('email',  $user->email)->get();

        $whereCondition = [

            ['state', '=', $request->state],
            ['cbo_name', '=', $request->cbo],
            ['quarter', '=', $request->quarter],

        ];

        if ($request->state != "") {
            $client_exit = ClientExitQuestionare::where($whereCondition)->get();
        }


        if ($role == "Spo") {

            foreach ($spouser as $spo_detail) {
                $state = $spo_detail->state;
                $state_name = substr($state, 0, strpos($state, ' '));
                $state = States::where('name', $state_name)->get();
            }

            return view('backend.cei_analysis.cei_analysis')->with([
                'state' => $state,
                'states' => [],
                'ceis' => $client_exit,
            ]);

        } else {

            return view('backend.cei_analysis.cei_analysis')->with([
                'states' => $state,
                'state' => [],
                'ceis' => $client_exit,
            ]);
        }
    }

    public function cei_analysis_fetch(Request $request)
    {
        $cbo = Cbo::where('state', $request->value)->get();

        return response()->json($cbo);
    }

    public function kobocei_analysis()
    {
        $state = States::all();
        $ceis = [];
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spouser = Spo::where('email',  $user->email)->get();


        if ($role == "Spo") {

            foreach ($spouser as $spo_detail) {
                $state = $spo_detail->state;
                $state_name = substr($state, 0, strpos($state, ' '));
                $state = States::where('name', $state_name)->get();
            }

            return view('backend.cei_analysis.kobocei_analysis')->with([
                'state' => $state,
                'states' => [],
                'ceis' => $ceis,
            ]);
        } else {

            return view('backend.cei_analysis.kobocei_analysis')->with([
                'states' => $state,
                'state' => [],
                'ceis' => $ceis,
            ]);
        }


    }

    public function kobo_analysis_table(Request $request)
    {

        $state = States::all();
        $client_exit = [];
        $user = Auth::user();
        $role = implode(' ', $user->roles->pluck('name')->toArray());
        $spouser = Spo::where('email',  $user->email)->get();

        $whereCondition = [
            ['state', '=', $request->state],
            ['qtr', '=', $request->quarter],
            ['cboemail', '=', $request->cbo],

        ];

        if ($request->state != "") {
            $client_exit = Cei::where($whereCondition)->get();

        }

        if ($role == "Spo") {

            foreach ($spouser as $spo_detail) {
                $state = $spo_detail->state;
                $state_name = substr($state, 0, strpos($state, ' '));
                $state = States::where('name', $state_name)->get();
            }

            return view('backend.cei_analysis.kobocei_analysis')->with([
                'state' => $state,
                'states' => [],
                'ceis' => $client_exit,
            ]);

        } else {

            return view('backend.cei_analysis.kobocei_analysis')->with([
                'states' => $state,
                'state' => [],
                'ceis' => $client_exit,
            ]);
        }
    }

    public function cei_monthly()
    {
        return view('backend.cei_analysis.ceimonthly')->with([]);
    }

    public function cei_quarterly()
    {
        return view('backend.cei_analysis.ceiquarterly')->with([]);
    }
}
