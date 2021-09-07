<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CboMonthly extends Model
{
    use HasFactory;

    protected $table = 'cbo_monthly_minutes';
    protected $fillable = [
        'cbo_name',
        'email',
        'state',
        'lga',
        'phone',
        'contact_person',
        'date_of_engagement',
        'date_of_establishment',
        'physical_contact_address',
        'attachment',
        'minutes_of_meeting',
        'date_of_meeting',
        'cbo_name',
        'month',
        'year',
        'quarter',

    ];
}
