<?php

namespace App\Http\Controllers;

use App\Models\Fgdreport;
use App\Models\States;
use Illuminate\Http\Request;

class FgdAnalysisController extends Controller
{
    public function otherreports_yearly(Request $request)
    {

        /* get count */

        // dd($request->state,$request->month);
        if (($request->state == 'all_states') && ($request->quarter != 'all_quarter')) {

            $fdg = Fgdreport::where([
                'year' => $request->year,
                'activity' => $request->activity
            ])->count();

        } else {

            /* get count of requested cei */
            $fdg = Fgdreport::where([
                'state' => $request->state,
                'year' => $request->year,
                'activity' => $request->activity
            ])->count();
        }

        // generate new array of data
        $data = [
            'cei_id' => '1',
            'cei_state' => $request->state,
            'cei_year' => $request->year,
            'cei_activity' => $request->activity,
            'cei_record_count' => $fdg
        ];

        //redirect back with data
        return redirect()->back()->with($data);
    }

    public function otherreportsquarterly(Request $request)
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

                $clientexit = Fgdreport::where([
                    'quarter' => $request->quarter,
                    'activity' => $request->activity
                ])->count();
            } else {

                /* get count of requested cei */
                $clientexit = Fgdreport::where([
                    'state' => $request->state,
                    'quarter' => $request->quarter,
                    'activity' => $request->activity
                ])->count();
            }


            // generate new array of data
            $data = [
                'myid' => '1',
                'state' => $request->state,
                'quarter' => $request->quarter,
                'activity' => $request->activity,
                'record_count' => $clientexit
            ];

            //merge two arrays
            $merged_data = array_merge($params, $data);

            return redirect()->back()->with($merged_data);
        } else {
            return view('backend.fgd.otherreports')->with($params);
        }
    }
}
