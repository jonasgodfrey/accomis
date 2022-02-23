<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cei extends Model
{
    use HasFactory;
    protected $table = 'ceis';
    // protected $guarded = [];

    protected $fillable = ['recordid',            
           'start',
           'end',
           'today',
           'state',
           'lga',
           'cbo',
           'ward',
           'hf',
           'qtr',
           'resp_name',
           'child_name',
           'resp_cat',
           'address',
           'phone',
           'occupation',
           'other_occupation',
           'resp_edu',
           'other_edu',
           'service_cat',
           'other_cat',
           'serv_received',
           'other_received',
           'freq_visit',
           'llin_recipient',
           'llin_where',
           'where_others',
           'llin_freq',
           'llin_sleep',
           'sleep_often',
           'why_no',
           'ipt_recipient',
           'freq_ipt',
           'given_sp',
           'sp_recipient',
           'sp_no',
           'why_others',
           'smc_recipient',
           'smc_age',
           'malaria',
           'mal_result',
           'tested_when',
           'act_recipient',
           'drug_received',
           'act_finish',
           'drug_finish_no',
           'rating',
           'dissatisfied',
           'others',
           'satisfied',
           'suggestion',
           'store_gps',
           'upload_image', 'created_at', "updated_at"
        ];
}
