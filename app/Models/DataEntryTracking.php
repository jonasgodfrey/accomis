<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntryTracking extends Model
{
    use HasFactory;

    protected $fillable=[
        'start',
        'limit'
    ];

    protected $table='data_entry_trackings';
}
