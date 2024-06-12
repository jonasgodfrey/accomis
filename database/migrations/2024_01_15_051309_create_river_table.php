<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river', function (Blueprint $table) {
           
            $table->string('_id')->unique();
            $table->string('start');
            $table->string('end');
            $table->string('today');
            $table->string('state');
            $table->string('lga');
            $table->string('afp');
            $table->string('email');
            $table->string('ward');
            $table->string('community');
            $table->string('hf');
            $table->string('condition');
            $table->string('oic');
            $table->string('designation');
            $table->string('full_suite_mal');
            $table->string('mal_testing');
            $table->string('func_lab');
            $table->string('ipm_availability');
            $table->string('sd_availability');
            $table->string('training_mal');
            $table->string('supportive_super');
            $table->string('dev_checklist');
            $table->string('population_size');
            $table->string('distance');
            $table->string('population_size_001');
            $table->string('record_officer');
            $table->string('means_reportn');
            $table->string('access_hf');
            $table->string('percent_access');
            $table->string('percentreg');
            $table->string('retired_personnel');
            $table->string('fundedproject');
            $table->string('avail_store');
            $table->string('mal_comodity');
            $table->string('quality_of_storage');
            $table->string('storage_access');
            $table->string('seq_hfstorage');
            $table->string('comm_support');
            $table->string('func_grievance');
            $table->string('redressmech');
            $table->string('others_redress');
            $table->string('suggestionbox');
            $table->string('hcwm_availability');
            $table->string('color_codes');
            $table->string('protectivegear');
            $table->string('temp_site4waste');
            $table->string('waste_treatment');
            $table->string('c19prevention');
            $table->string('icu');
            $table->string('population');
            $table->string('address');
            $table->string('upload_image');
            $table->string('store_gps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('river');
    }
}
