<?php

namespace App\Console\Commands;

use App\Models\ApiFetchTracker;
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

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get('https://kobo.humanitarianresponse.info/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json&limit=10&start=1');

        $collection = json_decode($collection->getBody(true)->getContents());

        $startValue = count($collection);

        \Log::info("Ending value is now $startValue");

        $getStart->starting_value = $getStart->starting_value +  $startValue;
        $getStart->save();
    }
}
