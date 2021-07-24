<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientExitQuestionare extends Model
{
    use HasFactory;
    protected $table = 'client_exit_questionare';
    protected $fillable = [
        'respondant_name',
        'child_name',
        'respondant_category',
        'respondant_address',
        'respondant_number',
        'health_facility_of_interview',
        'respondant_occupation',
        'respondant_education',
        'purpose_of_comming',
        'treatment_received',
        'frequency_of_visit_3months',
        'llin_reception',
        'llin_reception_location',
        'sleep_in_llin',
        'sleep_in_llin_interval',
        'reason_for_not_sleeping_in_llin',
        'frequency_of_llin_reception',
        'ipt_reception',
        'frequency_of_ipt_reception',
        'sulfadoxin_pyrimethamine_intake',
        'sulfadoxin_nonintake_reasons',
        'child_smc_reception',
        'child_smc_reception_age',
        'malaria_test',
        'malaria_test_reason',
        'malaria_test_period',
        'abc_therapy_reception',
        'recieved_medication',
        'medication_completion_status',
        'abc_input_details',
        'service_satisfaction_level',
        'service_satisfaction_level_reason',
        'service_satisfaction_aid',
        'facility_improvment_suggestion',
        'auth_user_email',
        'spo',
        'state',
        'month',
        'year',
        'day',
        'quarter',
    ];
}
