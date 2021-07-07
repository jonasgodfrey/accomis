<?php

namespace Database\Seeders;

use App\Models\Cbo;
use Illuminate\Database\Seeder;
use App\Models\User;

class CbosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cbo::create([
            'cbo_name' => 'Cbo',
            'email' => 'cbo@accomis.com',
            'phone' => '09099346373',
            'state' => 'Gombe',
            'lga' => 'Balanga',
            'contact_person' => 'contact man',
            'date_of_engagement' => '2021-05-10',
            'date_of_establishment' => '2021-05-16',
            'physical_contact_address' => 'Kaduna, Nigeria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
