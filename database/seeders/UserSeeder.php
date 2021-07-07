<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'Admin')->first();
        $cboRole = Role::where('name', 'Cbo')->first();
        $spoRole = Role::where('name', 'Spo')->first();
        $meRole = Role::where('name', 'Me')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@acomin.org',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cbo = User::create([
            'name' => 'Cbo',
            'email' => 'cbo@acomin.org',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $spo = User::create([
            'name' => 'Spo',
            'email' => 'spo@acomin.org',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $me = User::create([
            'name' => 'Me',
            'email' => 'me@acomin.org',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin->roles()->attach($adminRole);
        $cbo->roles()->attach($cboRole);
        $spo->roles()->attach($spoRole);
        $me->roles()->attach($meRole);
    }
}
