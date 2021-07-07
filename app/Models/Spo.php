<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spo extends Model
{
    use HasFactory;
    protected $fillable = [
        'spo_name',
        'email',
        'state',
        'phone',
        'physical_contact_address',
    ];
}
