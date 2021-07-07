<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            [
                "name" => "Abia",
                "spo" => "null",
                "status"=>"null",
            ],
            [
                "name" => "Adamawa",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Akwa Ibom",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Anambra",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Bauchi",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Bayelsa",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Benue",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Borno",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Cross River",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Delta",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Ebonyi",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Edo",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Ekiti",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Enugu",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "FCT - Abuja",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Gombe",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Imo",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Jigawa",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Kaduna",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Kano",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Katsina",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Kebbi",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Kogi",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Kwara",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Lagos",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Nasarawa",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Niger",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Ogun",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Ondo",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Osun",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Oyo",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Plateau",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Rivers",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Sokoto",
                "spo" => "null",
                "status" => "null",
            ],
            [
                "name" => "Taraba",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Yobe",
                "spo" => "null",
                "status" => "active",
            ],
            [
                "name" => "Zamfara",
                "spo" => "null",
                "status" => "null",
            ],
        ]);
    }
}
