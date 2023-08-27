<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

        $collection = Http::withBasicAuth('acomin', 'itsupport@acomin.org')->get('https://kobo.humanitarianresponse.info/assets/acM6WkAQpDKeMpvVx7uDSe/submissions/?format=json&limit=10&start=1');

        $collection = json_decode($collection->getBody(true)->getContents());

        \Log::info($collection);
    }
}
