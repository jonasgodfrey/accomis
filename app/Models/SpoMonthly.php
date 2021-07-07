<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpoMonthly extends Model
{
    use HasFactory;

    protected $table = 'spo_monthly_minutes';
    protected $fillable = [
        'name',
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
        'month',
        'year',
    ];
}
