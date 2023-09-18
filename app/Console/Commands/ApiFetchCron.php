<?php

namespace App\Console\Commands;

use App\Models\ApiFetchTracker;
use App\Models\Cei;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ApiFetchCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apifetch:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $getStart = ApiFetchTracker::find(1);

        $startValue = $getStart->starting_value;

        \Log::info("Initial starting value is $startValue");

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get("https://kobo.humanitarianresponse.info/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json&limit=20&start=$startValue");


        \Log::info($collection->json());
        
        $collection = json_decode($collection->getBody(true)->getContents());

        $collectionCount = count($collection);

        if ($collectionCount > 0) {

            $startValue = count($collection) + $getStart->starting_value;

            \Log::info("Ending value is now $startValue");


            foreach ($collection as $key => $row) {
                // dd($collection);

                $record  = Cei::insertOrIgnore([
                    "recordid" => $row->_id,
                    "start" => $row->start,
                    "end" => $row->end,
                    "today" => $row->today,
                    "month" => isset($row->month) ? $row->month : '',
                    "year" => isset($row->year) ? $row->year : '',
                    "state" =>  $row->state,
                    "lga" => $row->lga,
                    "cbo" => $row->cbo,
                    "cboemail" => $row->cboemail,
                    "ward" => isset($row->ward) ? $row->ward : '',
                    "hf" => $row->hf,
                    "qtr" => $row->qtr,
                    "resp_name" => isset($row->resp_name) ? $row->resp_name : '',
                    "child_name" => isset($row->child_name) ? $row->child_name : '',
                    "resp_cat" => isset($row->resp_cat) ? $row->resp_cat : '',
                    "address" => isset($row->address) ? $row->address : '',
                    "phone" => isset($row->phone) ? $row->phone : '',
                    "occupation" => isset($row->occupation) ? $row->occupation : '',
                    "other_occupation" => isset($row->other_occupation) ? $row->other_occupation : '',
                    "resp_edu" => isset($row->resp_edu) ? $row->resp_edu : '',
                    "created_at" => isset($row->created_at) ? $row->created_at : '',
                    "updated_at" => isset($row->updated_at) ? $row->updated_at : '',
                    "other_edu" => isset($row->other_edu) ? $row->other_edu : '',
                    "service_cat" => isset($row->service_cat) ? $row->service_cat : '',
                    "serv_received" => isset($row->serv_received) ? $row->serv_received : '',
                    "other_received" => isset($row->other_received) ? $row->other_received : '',
                    "freq_visit" => isset($row->freq_visit) ? $row->freq_visit : '',
                    "llin_recipient" => isset($row->llin_recipient) ? $row->llin_recipient : '',
                    "llin_where" => isset($row->llin_where) ? $row->llin_where : '',
                    "where_others" => isset($row->where_others) ? $row->where_others : '',
                    "llin_where" => isset($row->llin_where) ? $row->llin_where : '',
                    "llin_freq" => isset($row->llin_freq) ? $row->llin_freq : '',
                    "llin_freq" => isset($row->llin_freq) ? $row->llin_freq : '',
                    "llin_sleep" => isset($row->llin_sleep) ? $row->llin_sleep : '',
                    "sleep_often" => isset($row->sleep_often) ? $row->sleep_often : '',
                    "why_no" => isset($row->why_no) ? $row->why_no : '',
                    "ipt_recipient" => isset($row->ipt_recipient) ? $row->ipt_recipient : '',
                    "freq_ipt" => isset($row->freq_ipt) ? $row->freq_ipt : '',
                    "sp_recipient" => isset($row->sp_recipient) ? $row->sp_recipient : '',
                    "given_sp" => isset($row->given_sp) ? $row->given_sp : '',
                    "sp_no" => isset($row->sp_no) ? $row->sp_no : '',
                    "why_others" => isset($row->why_others) ? $row->why_others : '',
                    "smc_recipient" => isset($row->smc_recipient) ? $row->smc_recipient : '',
                    "smc_age" => isset($row->smc_age) ? $row->smc_age : '',
                    "malaria" => isset($row->malaria) ? $row->malaria : '',
                    "tested_when" => isset($row->tested_when) ? $row->tested_when : '',
                    "act_recipient" => isset($row->act_recipient) ? $row->act_recipient : '',
                    "drug_received" => isset($row->drug_received) ? $row->drug_received : '',
                    "act_finish" => isset($row->act_finish) ? $row->act_finish : '',
                    "drug_finish_no" => isset($row->drug_finish_no) ? $row->drug_finish_no : '',
                    "rating" => isset($row->rating) ? $row->rating : '',
                    "dissatisfied" => isset($row->dissatisfied) ? $row->dissatisfied : '',
                    "others" => isset($row->others) ? $row->others : '',
                    "satisfied" => isset($row->satisfied) ? $row->satisfied : '',
                    "suggestion" => isset($row->suggestion) ? $row->suggestion : '',
                    "upload_image" => isset($row->upload_image) ? $row->upload_image : '',
                    "store_gps" => isset($row->store_gps) ? $row->store_gps : ''

                ]);
            }


            $getStart->starting_value = $startValue;
            $getStart->save();
        }
    }
}
