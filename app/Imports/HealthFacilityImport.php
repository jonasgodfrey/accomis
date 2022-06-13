<?php

namespace App\Imports;

use App\Models\HealthFacility;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class HealthFacilityImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $month = date('M');
        $day = date('d');
        $year = date('Y');

        foreach ($rows as $key => $value) {
            if($key > 0){
                $health = HealthFacility::insertOrIgnore([
                    'State' => $value[1],
                    'LGA' => $value[2],
                    'Ward' => $value[3],
                    'Facility' => $value[4],
                    'CBO' => $value[5],
                    'CBO_Email' => $value[6],
                    'SPO' => $value[7],
                    'SPO_Email' => $value[8],
                    'status' => $value[9],
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                ]);

            }

        }

    }
}
