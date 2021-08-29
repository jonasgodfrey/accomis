<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientExitQuestionareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_exit_questionare', function (Blueprint $table) {
            $table->id();
            $table->string('respondant_name');
            $table->string('child_name')->nullable();
            $table->string('respondant_category');
            $table->string('respondant_address');
            $table->string('respondant_number');
            $table->string('health_facility_of_interview');
            $table->string('respondant_occupation');
            $table->string('respondant_education');
            $table->string('purpose_of_comming');
            $table->string('treatment_received');
            $table->string('frequency_of_visit_3months');
            $table->string('llin_reception');
            $table->string('llin_reception_location')->nullable();
            $table->string('frequency_of_llin_reception')->nullable();
            $table->string('sleep_in_llin')->nullable();
            $table->string('sleep_in_llin_interval')->nullable();
            $table->string('reason_for_not_sleeping_in_llin')->nullable();
            $table->string('ipt_reception');
            $table->string('frequency_of_ipt_reception')->nullable();
            $table->string('sulfadoxin_pyrimethamine_intake');
            $table->string('sulfadoxin_nonintake_reasons')->nullable();
            $table->string('child_smc_reception');
            $table->string('child_smc_reception_age')->nullable();
            $table->string('malaria_test');
            $table->string('malaria_test_reason')->nullable();
            $table->string('malaria_test_period')->nullable();
            $table->string('abc_therapy_reception');
            $table->string('recieved_medication');
            $table->string('medication_completion_status')->nullable();
            $table->string('abc_input_details');
            $table->string('service_satisfaction_level');
            $table->string('service_satisfaction_level_reason');
            $table->string('service_satisfaction_aid');
            $table->string('facility_improvment_suggestion');
            $table->string('auth_user_email');
            $table->string('spo')->nullable();
            $table->string('state');
            $table->string('month');
            $table->string('year');
            $table->string('day');
            $table->string('quarter');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_exit_questionare');
    }
}
