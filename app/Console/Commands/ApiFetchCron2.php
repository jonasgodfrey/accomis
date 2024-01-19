<?php

namespace App\Console\Commands;

use App\Models\ApiFetchTracker;
use App\Models\River;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ApiFetchCron2 extends Command
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

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get("https://eu.kobotoolbox.org/assets/a5xGSvj4wPkAJBsisXsvqH/submissions/?format=json&limit=20&start=$startValue");
        
        $collection = json_decode($collection->getBody(true)->getContents());

        $collectionCount = count($collection);

        if ($collectionCount > 0) {

            $startValue = count($collection) + $getStart->starting_value;

            \Log::info("Ending value is now $startValue");


            foreach ($collection as $key => $row) {
                // dd($collection);

                $record  = River::insertOrIgnore([
                    "_id"=> $row->_id,
                    "start"=> $row->start,
                    "end"=> $row->end,
                    "today"=> $row->today,   
                    "state"=>isset($row->state) ? $row->state : '',
                    "lga"=> isset($row->lga) ? $row->lga : '',
                    "afp"=> isset($row->afp) ? $row->afp : '',
                    "email"=> isset($row->email) ? $row->email : '',
                    "ward"=> isset($row->ward) ? $row->ward : '',
                    "community"=> isset($row->community) ? $row->community : '',
                    "hf"=> isset($row->hf) ? $row->hf : '',
                    "condition"=> isset($row->condition) ? $row->condition : '',
                    "oic"=> isset($row->oic) ? $row->oic : '',
                    "designation"=> isset($row->designation) ? $row->designation : '',
                    "full_suite_mal"=> isset($row->full_suite_mal) ? $row->full_suite_mal : '',
                    "mal_testing"=> isset($row->mal_testing) ? $row->mal_testing : '',
                    "func_lab"=> isset($row->func_lab) ? $row->func_lab : '',
                    "ipm_availability"=> isset($row->ipm_availability) ? $row->ipm_availability : '',
                    "sd_availability"=> isset($row->sd_availability) ? $row->sd_availability : '',
                    "training_mal"=> isset($row->training_mal) ? $row->training_mal : '',
                    "supportive_super"=> isset($row->supportive_super) ? $row->supportive_super : '',
                    "dev_checklist"=> isset($row->dev_checklist) ? $row->dev_checklist : '',
                    "population_size"=> isset($row->population_size) ? $row->population_size : '',
                    "distance"=> isset($row->distance) ? $row->distance : '',
                    "population_size_001"=> isset($row->population_size_001) ? $row->population_size_001 : '',
                    "record_officer"=> isset($row->record_officer) ? $row->record_officer : '',
                    "means_reportn"=> isset($row->means_reportn) ? $row->means_reportn : '',
                    "access_hf"=> isset($row->access_hf) ? $row->access_hf : '',
                    "percent_access"=> isset($row->percent_access) ? $row->percent_access : '',
                    "percentreg"=> isset($row->percentreg) ? $row->percentreg : '',
                    "retired_personnel"=> isset($row->retired_personnel) ? $row->retired_personnel : '',
                    "fundedproject"=> isset($row->fundedproject) ? $row->fundedproject : '',
                    "avail_store"=> isset($row->avail_store) ? $row->avail_store : '',
                    "mal_comodity"=> isset($row->mal_comodity) ? $row->mal_comodity : '',
                    "quality_of_storage"=> isset($row->quality_of_storage) ? $row->quality_of_storage : '',
                    "storage_access"=> isset($row->storage_access) ? $row->storage_access : '',
                    "seq_hfstorage"=> isset($row->seq_hfstorage) ? $row->seq_hfstorage : '',
                    "comm_support"=> isset($row->comm_support) ? $row->comm_support : '',
                    "func_grievance"=> isset($row->func_grievance) ? $row->func_grievance : '',
                    "redressmech"=> isset($row->redressmech) ? $row->redressmech : '',
                    "others_redress"=> isset($row->others_redress) ? $row->others_redress : '',
                    "suggestionbox"=> isset($row->suggestionbox) ? $row->suggestionbox : '',
                    "hcwm_availability"=> isset($row->hcwm_availability) ? $row->hcwm_availability : '',
                    "color_codes"=> isset($row->color_codes) ? $row->color_codes : '',
                    "protectivegear"=> isset($row->protectivegear) ? $row->protectivegear : '',
                    "temp_site4waste"=> isset($row->temp_site4waste) ? $row->temp_site4waste : '',
                    "waste_treatment"=> isset($row->waste_treatment) ? $row->waste_treatment : '',
                    "c19prevention"=> isset($row->c19prevention) ? $row->c19prevention : '',
                    "icu"=> isset($row->icu) ? $row->icu : '',
                    "population"=> isset($row->population) ? $row->population : '',
                    "address"=> isset($row->address) ? $row->address : '',
                    "upload_image"=> isset($row->upload_image) ? $row->upload_image : '',
                    "store_gps"=> isset($row->store_gps) ? $row->store_gps : ''    

                ]);
            }


            $getStart->starting_value = $startValue;
            $getStart->save();
        }
    }
}
