<?php

namespace App\Http\Controllers;

use App\Models\Fgdreport;
use App\Models\States;
use Illuminate\Http\Request;

class FgdAnalysisController extends Controller
{

    public function otherreportsquarterly(Request $request)
    {
        $states = States::all();
        $active_states = States::where('status', 'active')->get();

        $data = [];

        $params = [
            'states' => $states,
            'data' => $data,
        ];

        if ($request->submit != "") {

            /* get count */
            if (($request->state == 'all_states')) {

                /**
                 *  Get all states data based on where condition
                 */
                foreach ($active_states as $data) {

                    $fdg_record = Fgdreport::where([
                        'state' => $data->name,
                        'quarter' => $request->quarter,
                        'activity' => $request->activity
                    ])->get();

                    /* store fetched data into an array */
                    $state_data[] = [
                        'state_name' => $data->name,
                        'count' => $fdg_record->count(),
                        'quarter' => $request->quarter
                    ];
                }
                

            } else {

                /* get count of requested cei */
                $fdg_record = Fgdreport::where([
                    'state' => $request->state,
                    'quarter' => $request->quarter,
                    'activity' => $request->activity
                ])->get();

                /* store fetched data into an array */
                $state_data[] = [
                    'state_name' => $request->state,
                    'count' => $fdg_record->count(),
                    'quarter' => $request->quarter
                ];
            
            }


            // generate new array of data
            $data = [
                'state' => $request->state,
                'activity' => $request->activity,
                'qtr_records' => $state_data
            ];

            //merge two arrays
            $merged_data = array_merge($params, $data);
            
            return redirect()->back()->with($merged_data);
        } else {
            return view('backend.fgd.otherreports')->with($params);
        }
    }

    public function otherreports_yearly(Request $request)
    {
        $active_states = States::where('status', 'active')->get();

        if (($request->state == 'all_states')) {

            /**
             *  Get all states data based on where condition
             */
            foreach ($active_states as $data) {

                $fdg_record = Fgdreport::where([
                    'state' => $data->name,
                    'year' => $request->year,
                    'activity' => $request->activity
                ])->get();

                /* store fetched data into an array */
                $state_data[] = [
                    'state_name' => $data->name,
                    'count' => $fdg_record->count(),
                    'year' => $request->year
                ];
            }
                
        } else {

            /* get count of requested cei */
            $fdg_record = Fgdreport::where([
                'state' => $request->state,
                'year' => $request->year,
                'activity' => $request->activity
            ])->get();

            /* store fetched data into an array */
            $state_data[] = [
                'state_name' => $request->state,
                'count' => $fdg_record->count(),
                'year' => $request->year
            ];
            
        }

        // generate new array of data
        $data = [
            'state' => $request->state,
            'year' => $request->year,
            'activity' => $request->activity,
            'fgd_year_data' => $state_data
        ];

        //redirect back with data
        return redirect()->back()->with($data);
    }
}
