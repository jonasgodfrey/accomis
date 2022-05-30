<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;
use App\Models\ClientExitQuestionare;
use App\Models\Cei;
use Illuminate\Support\Facades\Auth;
use App\Models\Spo;
use App\Models\Cbo;
use Carbon\Carbon;
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

    public function cei_monthly(Request $request)
    {
        /**
         * Query ClientExit DB for states record count and return view with array.
         *
         * @return view
         */

        $states = States::all();
        $active_states = States::where('status', 'active')->get();
        $months = [];
        $cei_months = [];
        $years = ClientExitQuestionare::groupBy('year')->pluck('year')->toArray();
        $state_data = [];
        $clientexit = '';

        for ($m = 1; $m <= 12; $m++) {
            $months[] = date('M', mktime(0, 0, 0, $m, 1, date('Y')));
        }

        for ($m = 1; $m <= 12; $m++) {
            $cei_months[] = ['month_name' => date('F', mktime(0, 0, 0, $m, 10)), 'month_num' => $m];
        }

        $params = [
            'months' => $months,
            'states' => $states,
            'years' => $years,
            'cei_months' => $cei_months,
            'data' => [],
        ];

        if ($request->submit != "") {

            if (($request->state != 'all_states') && ($request->month == 'all_months')) {

                /* get requested cei data */
                $clientexit = ClientExitQuestionare::where([
                    'state' => $request->state,
                    'year' => $request->year
                ])->get();

                /* store fetched data into an array */
                $state_data[] = ['state_name' => $request->state, 'count' => $clientexit->count()];
            } elseif (($request->state == 'all_states') && ($request->month != 'all_months')) {

                /* get all states data based on condition*/
                foreach ($active_states as $data) {
                    $states_client_record = ClientExitQuestionare::where([
                        'state' => $data->name,
                        'month' => $request->month,
                        'year' => $request->year,
                    ])->get();

                    /* store fetched data into an array */
                    $state_data[] = ['state_name' => $data->name, 'count' => $states_client_record->count()];
                }
            } elseif (($request->state == 'all_states') && ($request->month == 'all_months')) {

                /* get all states data based on condition*/
                foreach ($active_states as $data) {
                    $states_client_record = ClientExitQuestionare::where([
                        'state' => $data->name,
                        'year' => $request->year,
                    ])->get();

                    /* store fetched data into an array */
                    $state_data[] = ['state_name' => $data->name, 'count' => $states_client_record->count()];
                }
            } else {

                /* get count of requested cei */
                $clientexit = ClientExitQuestionare::where([
                    'state' => $request->state,
                    'month' => $request->month,
                    'year' => $request->year
                ])->get();

                /* store fetched data into an array */
                $state_data[] = ['state_name' => $request->state, 'count' => $clientexit->count()];
            }

            //generate new array of data
            $data = [
                'state' => $request->state,
                'month' => $request->month,
                'year' => $request->year,
                'states_data' => $state_data
            ];

            // merge newly created array with the orignal $params array
            $merged_data = array_merge($params, $data);

            // return new array back to the view
            return redirect()->back()->with($merged_data);
        } else {
            //
            return view('backend.cei_analysis.ceimonthly')->with($params);
        }
    }

    public function kobo_cei_monthly(Request $request)
    {

        /* get count */

        // dd($request->state,$request->month);
        if (($request->state != 'all_states') && ($request->month == 'all_months')) {
            $cei = Cei::where('state', $request->state)->count();
        } elseif (($request->state == 'all_states') && ($request->month != 'all_months')) {
            /* get count */
            $cei = Cei::whereMonth('created_at', '=', $request->month)->count();
        } elseif (($request->state == 'all_states') && ($request->month == 'all_months')) {
            $cei = Cei::all()->count();
        } else {

            /* get count of requested cei */
            $cei = Cei::whereMonth('created_at', '=', $request->month)->where([
                'state' => $request->state,
            ])->count();
        }

        // generate new array of data
        $data = [
            'cei_id' => '1',
            'cei_state' => $request->state,
            'cei_month' => $request->month,
            'cei_record_count' => $cei
        ];

        //redirect back with data
        return redirect()->back()->with($data);
    }


    public function kobo_cei_quarterly(Request $request)
    {

        /* get count */

        // dd($request->state,$request->month);
        if (($request->state == 'all_states') && ($request->quarter != 'all_quarter')) {

            $cei = Cei::where('qtr', $request->quarter)->count();
        }
        elseif (($request->state == 'all_states') && ($request->quarter == 'all_quarter')) {
            $cei = Cei::all()->count();
        } else {

            /* get count of requested cei */
            $cei = Cei::where([
                'state' => $request->state,
                'qtr' => $request->quarter
            ])->count();
        }

        // generate new array of data
        $data = [
            'cei_id' => '1',
            'cei_state' => $request->state,
            'cei_quarter' => $request->quarter,
            'cei_record_count' => $cei
        ];

        //redirect back with data
        return redirect()->back()->with($data);
    }

    public function cei_quarterly(Request $request)
    {
        $states = States::all();
        $data = [];

        $params = [
            'states' => $states,
            'data' => $data,
        ];

        if ($request->submit != "") {

            /* get count */
            if (($request->state == 'all_states')) {

                $clientexit = ClientExitQuestionare::where('quarter', $request->quarter)->count();
            } else {

                /* get count of requested cei */
                $clientexit = ClientExitQuestionare::where([
                    'state' => $request->state,
                    'quarter' => $request->quarter
                ])->count();
            }


            // generate new array of data
            $data = [
                'myid' => '1',
                'state' => $request->state,
                'quarter' => $request->quarter,
                'record_count' => $clientexit
            ];

            //merge two arrays
            $merged_data = array_merge($params, $data);

            return redirect()->back()->with($merged_data);
        } else {
            return view('backend.cei_analysis.ceiquarterly')->with($params);
        }
    }
}
