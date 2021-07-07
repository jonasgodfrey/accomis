<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();

        Role::create([
            'name' => 'Admin',
            'description' =>
            'somebody who has access to all the administration features within a this site.',
        ]);

        Role::create([
            'name' => 'Cbo',
            'description' =>
            'somebody who performs the work of the cbo.',
        ]);

        Role::create([
            'name' => 'Spo',
            'description' =>
            'somebody who performs the work of the spo.',
        ]);

        Role::create([
            'name' => 'Me',
            'description' =>
            'somebody who performs the work of the m&e officer.',
        ]);
    }
}
