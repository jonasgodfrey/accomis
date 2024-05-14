<?php

namespace App\Console\Commands;

use App\Models\ApiFetchTracker;
use App\Models\Cei;
use App\Models\DataEntry;
use App\Models\DataEntryTracking;
// use App\Models\Ceibackup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class ApiFetchCron extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $fillable = [
        '_id',
        'start',
        'end',
        'today',
        'consent',
        'service_cat',
        'serv_received',
        'other_received',
        'freq_visit',
        'year',
        'qtr',
        'month',
        'state',
        'lga',
        'cbo',
        'cboemail',
        'ward',
        'hf',
        'resp_name',
        'child_name',
        'resp_cat',
        'address',
        'phone',
        'resp_edu',
        'mal_info',
        'info_source',
        'prev_how',
        'given_med',
        'side_effect',
        'access_hf',
        'attended_by_hf',
        'offer_anc',
        'receive_ipt',
        'free_mal_aware',
        'denied_access',
        'payto_receive',
        'tested',
        'result_tested',
        'given_meds',
        'duration',
        'attitude',
        'gender_hw',
        'comf',
        'descrimination',
        'assess_quality',
        'hw_qty',
        'hiv_info',
        'infohiv_source',
        'hiv_prev',
        'hivmed_given',
        'hivdrug_side',
        'easilyto_hf',
        'attendedby_hf',
        'ancservice',
        'hivaids_aware',
        'deniedhiv_serv',
        'kindofserv',
        'hivduration',
        'hivattitude',
        'hivgender_hw',
        'hivcomf',
        'hivdescrimination',
        'hivassess_quality',
        'hivhw_qty',
        'tb_info',
        'tb_source',
        'prev_tb',
        'tbdrug_given',
        'drug_sideeffect',
        'tbsideeffect_exp',
        'tbaccess_hf',
        'tbhw',
        'tbanc',
        'freetbaware',
        'tbservdeny',
        'kindtbserv',
        'paytbserv',
        'tbduration',
        'tbattitude',
        'tbgender_hw',
        'tbcomf',
        'tbdescrimination',
        'tbassess_quality',
        'tbhw_qty',
        'store_gps',
        '_submission_time'
    ];
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

    public function cleanDateUp($apiData, $limit, $startValue)
    {
        try {
            $cleanedData = [];
            foreach ($apiData as $item) {
                $cleanedItem = []; // Create a new empty stdClass object
                foreach ($item as $key => $value) {
                    $newKey = explode('/', $key);
                    if (count($newKey) == 2) {
                        $newKey = $newKey[1];
                    } else {
                        $newKey = $newKey[0];
                    }
                    // // Add the key-value pair to the cleaned item
                    $cleanedItem[$newKey] = $value;
                }
                // Log::alert($cleanedItem);
                // Add the cleaned item to the cleaned data array
                // $cleanedData[] = $cleanedItem;
                try {
                    DataEntry::create($cleanedItem);
                } catch (\Exception $e) {
                    Log::alert($e);
                }
            }

            DataEntryTracking::updateOrCreate(['id' => 1], [
                'limit' => $limit,
                'start' => $startValue
            ]);

            // return $cleanedData;
        } catch (\Exception $e) {
            Log::info("Error in cleaning date up" . $e);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

<<<<<<< HEAD
        $getStart = ApiFetchTracker::find(1);

        $startValue = $getStart->starting_value;

        \Log::info("Initial starting value is $startValue");

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get("https://eu.kobotoolbox.org/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json&limit=20&start=$startValue");
        
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
                    // "state" =>  $row->state,
                    "state" => isset($row->state) ? $row->state : '',
                    "lga" => isset($row->lga) ? $row->lga : '',
                    "cbo" => isset($row->cbo) ? $row->cbo : '',
                    "cboemail" => isset($row->cboemail) ? $row->cboemail : '',
                    "ward" => isset($row->ward) ? $row->ward : '',
                    "hf" => isset($row->hf) ? $row->hf : '',
                    "qtr" => isset($row->qtr) ? $row->qtr : '',
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
                    // "llin_where" => isset($row->llin_where) ? $row->llin_where : '',
                    // "llin_freq" => isset($row->llin_freq) ? $row->llin_freq : '',
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
=======
        $getStart = DataEntryTracking::find(1);
        if ($getStart != null) {
            $startValue = $getStart->start+$getStart->limit;
            $limit = $getStart->limit;
        } else {
            $startValue = 0;
            $limit = 20;
>>>>>>> rabi
        }


        Log::info("Initial starting value is $startValue");

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get("https://eu.kobotoolbox.org/assets/aCKPGzH3wHfNiHkJvpHjSm/submissions/?format=json&limit=$limit&start=$startValue");
        // $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get("https://eu.kobotoolbox.org/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json&limit=20&start=$startValue");

        $collection = json_decode($collection->getBody(true)->getContents());
        $collectionCount = count($collection);
        if ($collectionCount > 0) {
            $cleanData = $this->cleanDateUp($collection, $limit, $startValue);
        }
        Log::info($cleanData);
        // die;

        // if ($collectionCount > 0) {

        //     $startValue = count($collection) + $getStart->starting_value;

        //     \Log::info("Ending value is now $startValue");


        //     foreach ($collection as $key => $row) {
        //         // dd($collection);

        //         $record  = Cei::insertOrIgnore([
        //             "recordid" => $row->_id,
        //             "start" => $row->start,
        //             "end" => $row->end,
        //             "today" => $row->today,
        //             "month" => isset($row->month) ? $row->month : '',
        //             "year" => isset($row->year) ? $row->year : '',
        //             "state" =>  $row->state,
        //             "lga" => $row->lga,
        //             "cbo" => $row->cbo,
        //             "cboemail" => $row->cboemail,
        //             "ward" => isset($row->ward) ? $row->ward : '',
        //             "hf" => $row->hf,
        //             "qtr" => $row->qtr,
        //             "resp_name" => isset($row->resp_name) ? $row->resp_name : '',
        //             "child_name" => isset($row->child_name) ? $row->child_name : '',
        //             "resp_cat" => isset($row->resp_cat) ? $row->resp_cat : '',
        //             "address" => isset($row->address) ? $row->address : '',
        //             "phone" => isset($row->phone) ? $row->phone : '',
        //             "occupation" => isset($row->occupation) ? $row->occupation : '',
        //             "other_occupation" => isset($row->other_occupation) ? $row->other_occupation : '',
        //             "resp_edu" => isset($row->resp_edu) ? $row->resp_edu : '',
        //             "created_at" => isset($row->created_at) ? $row->created_at : '',
        //             "updated_at" => isset($row->updated_at) ? $row->updated_at : '',
        //             "other_edu" => isset($row->other_edu) ? $row->other_edu : '',
        //             "service_cat" => isset($row->service_cat) ? $row->service_cat : '',
        //             "serv_received" => isset($row->serv_received) ? $row->serv_received : '',
        //             "other_received" => isset($row->other_received) ? $row->other_received : '',
        //             "freq_visit" => isset($row->freq_visit) ? $row->freq_visit : '',
        //             "llin_recipient" => isset($row->llin_recipient) ? $row->llin_recipient : '',
        //             "llin_where" => isset($row->llin_where) ? $row->llin_where : '',
        //             "where_others" => isset($row->where_others) ? $row->where_others : '',
        //             // "llin_where" => isset($row->llin_where) ? $row->llin_where : '',
        //             // "llin_freq" => isset($row->llin_freq) ? $row->llin_freq : '',
        //             "llin_freq" => isset($row->llin_freq) ? $row->llin_freq : '',
        //             "llin_sleep" => isset($row->llin_sleep) ? $row->llin_sleep : '',
        //             "sleep_often" => isset($row->sleep_often) ? $row->sleep_often : '',
        //             "why_no" => isset($row->why_no) ? $row->why_no : '',
        //             "ipt_recipient" => isset($row->ipt_recipient) ? $row->ipt_recipient : '',
        //             "freq_ipt" => isset($row->freq_ipt) ? $row->freq_ipt : '',
        //             "sp_recipient" => isset($row->sp_recipient) ? $row->sp_recipient : '',
        //             "given_sp" => isset($row->given_sp) ? $row->given_sp : '',
        //             "sp_no" => isset($row->sp_no) ? $row->sp_no : '',
        //             "why_others" => isset($row->why_others) ? $row->why_others : '',
        //             "smc_recipient" => isset($row->smc_recipient) ? $row->smc_recipient : '',
        //             "smc_age" => isset($row->smc_age) ? $row->smc_age : '',
        //             "malaria" => isset($row->malaria) ? $row->malaria : '',
        //             "tested_when" => isset($row->tested_when) ? $row->tested_when : '',
        //             "act_recipient" => isset($row->act_recipient) ? $row->act_recipient : '',
        //             "drug_received" => isset($row->drug_received) ? $row->drug_received : '',
        //             "act_finish" => isset($row->act_finish) ? $row->act_finish : '',
        //             "drug_finish_no" => isset($row->drug_finish_no) ? $row->drug_finish_no : '',
        //             "rating" => isset($row->rating) ? $row->rating : '',
        //             "dissatisfied" => isset($row->dissatisfied) ? $row->dissatisfied : '',
        //             "others" => isset($row->others) ? $row->others : '',
        //             "satisfied" => isset($row->satisfied) ? $row->satisfied : '',
        //             "suggestion" => isset($row->suggestion) ? $row->suggestion : '',
        //             "upload_image" => isset($row->upload_image) ? $row->upload_image : '',
        //             "store_gps" => isset($row->store_gps) ? $row->store_gps : ''

        //         ]);
        //     }


        //     $getStart->starting_value = $startValue;
        //     $getStart->save();
        // }
    }
}
