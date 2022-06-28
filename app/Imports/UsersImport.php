<?php

namespace App\Imports;

use App\Models\Cbo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToCollection{

    public function collection(Collection $rows)
    {
        $cboRole = Role::where('name', 'Cbo')->first();
        foreach ($rows as $key => $value) {

            if($key > 0){
                // dd($value[1]);
                $user = User::create([
                    'name' => $value[1],
                    'email' => $value[2],
                    'email_verified_at' => now(),
                    'password' => Hash::make($value[4]),
                ]);

                $user->roles()->attach($cboRole);

                $cbo = Cbo::InsertOrIgnore([
                    'cbo_name' => $value[1],
                    'email' => $value[2],
                    'phone' =>  $value[3],
                    'state' => $value[4],
                    'lga' => $value[5],
                    'contact_person' => $value[6],
                    'date_of_engagement' => $value[7],
                    'date_of_establishment' => $value[8],
                    'physical_contact_address' => $value[9],
                ]);

            }
        }

    }
}


