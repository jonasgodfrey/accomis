<?php

namespace App\Imports;

use App\Models\Cbo;
use App\Models\Role;
use App\Models\Spo;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SpoImport implements ToCollection{

    public function collection(Collection $rows)
    {
        $spoRole = Role::where('name', 'Spo')->first();

        foreach ($rows as $key => $value) {
            if($key > 0){
                $password = substr($value[1], 0, strpos($value[1], ' '));
                $user = User::create([
                    'name' => $value[2],
                    'email' => $value[4],
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                ]);

                $user->roles()->attach($spoRole);

                $spo = Spo::create([
                    'spo_name' => $value[2],
                    'email' => $value[4],
                    'phone' =>  $value[3],
                    'state' => $value[1],
                    'physical_contact_address' => $value[4],
                ]);

            }
        }


    }
}


