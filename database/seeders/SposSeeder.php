<?php

namespace Database\Seeders;

use App\Models\Spo;
use Illuminate\Database\Seeder;

class SposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spo::create([
            'spo_name' => 'Spo',
            'email' => 'spo@accomis.com',
            'phone' => '08188286181',
            'state' => 'Gombe',
            'physical_contact_address' => 'Kaduna, Nigeria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
