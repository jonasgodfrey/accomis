<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    use HasFactory;
   

    protected $fillable = [
        '_id',
        'start',
        'end',
        'today' ,   
        'state',
        'lga',
        'afp',
        'email',
        'ward',
        'community',
        'hf',
        'condition',
        'oic',
        'designation',
        'full_suite_mal',
        'mal_testing',
        'func_lab',
        'ipm_availability',
        'sd_availability',
        'training_mal',
        'supportive_super',
        'dev_checklist',
        'population_size',
        'distance',
        'population_size_001',
        'record_officer',
        'means_reportn',
        'access_hf',
        'percent_access',
        'percentreg',
        'retired_personnel',
        'fundedproject',
        'avail_store',
        'mal_comodity',
        'quality_of_storage',
        'storage_access',
        'seq_hfstorage',
        'comm_support',
        'func_grievance',
        'redressmech',
        'others_redress',
        'suggestionbox',
        'hcwm_availability',
        'color_codes',
        'protectivegear',
        'temp_site4waste',
        'waste_treatment',
        'c19prevention',
        'icu',
        'population',
        'address',
        'upload_image',
        'store_gps'    
    
        ];
}

