<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        'State',
        'LGA' ,
        'Ward' ,
        'Facility',
        'CBO' ,
        'CBO_Email' ,
        'SPO' ,
        'SPO_Email' ,
        'status',
        'day',
        'month',
        'year',
    ];
}
