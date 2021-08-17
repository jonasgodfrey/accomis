<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedial extends Model
{
    use HasFactory;
    protected $table = 'remedial';
    protected $fillable = [
        'state',
        'ward',
        'cbo',
        'date_visit',
        'tracker_type',
        'identified_issues',
        'root_cause',
        'action_taken_immediately',
        'resolved',
        'follow_up_action',
        'responsibility',
        'timeline',
        'signed_document',
        'month',
        'year',
        'quarter',
    ];

}
