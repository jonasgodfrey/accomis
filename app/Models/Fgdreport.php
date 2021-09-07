<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fgdreport extends Model
{
    use HasFactory;

    protected $table = 'fgdreports';
    protected $fillable = [
        'cbo_name',
        'email',
        'state',
        'lga',
        'attachment',
        'date_of_activity',
        'month',
        'year',
        'quarter',
        'activity',
        'cbo_name'
    ];
}
