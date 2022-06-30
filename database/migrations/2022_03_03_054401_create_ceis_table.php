<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCeisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceis', function (Blueprint $table) {
<<<<<<< HEAD
            // $table->columntype('columnname');
            $table->string('recordid')->unique();
            $table->string('start');
            $table->string('end');
            $table->string('today');
            $table->string('month');
            $table->string('state');
            $table->string('lga');
            $table->string('cbo');
            $table->string('cboemail');
            $table->string('ward');
            $table->string('hf');
            $table->string('qtr');
            $table->string('resp_name');
            $table->string('child_name');
            $table->string('resp_cat');
            $table->string('address');
            $table->string('phone');
            $table->string('occupation');
            $table->string('other_occupation');
            $table->string('resp_edu');
            $table->string('other_edu');
            $table->string('service_cat');
            $table->string('other_cat');
            $table->string('serv_received');
            $table->string('other_received');
            $table->string('freq_visit');
            $table->string('llin_recipient');
            $table->string('llin_where');
            $table->string('where_others');
            $table->string('llin_freq');
            $table->string('llin_sleep');
            $table->string('sleep_often');
            $table->string('why_no');
            $table->string('ipt_recipient');
            $table->string('freq_ipt');
            $table->string('given_sp');
            $table->string('sp_recipient');
            $table->string('sp_no');
            $table->string('why_others');
            $table->string('smc_recipient');
            $table->string('smc_age');
            $table->string('malaria');
            $table->string('mal_result');
            $table->string('tested_when');
            $table->string('act_recipient');
            $table->string('drug_received');
            $table->string('act_finish');
            $table->string('drug_finish_no');
            $table->string('rating');
            $table->string('dissatisfied');
            $table->string('others');
            $table->string('satisfied');
            $table->string('suggestion');
            $table->string('store_gps');
            $table->string('upload_image');
=======
             // $table->columntype('columnname');
             $table->string('recordid')->unique();            
             $table->string('start');
             $table->string('end');
             $table->string('today');
             $table->string('month');
             $table->string('year');
             $table->string('state');
             $table->string('lga');
             $table->string('cbo');
             $table->string('cboemail');
             $table->string('ward');
             $table->string('hf');
             $table->string('qtr');
             $table->string('resp_name');
             $table->string('child_name');
             $table->string('resp_cat');
             $table->string('address');
             $table->string('phone');
             $table->string('occupation');
             $table->string('other_occupation');
             $table->string('resp_edu');
             $table->string('other_edu');
             $table->string('service_cat');
             $table->string('other_cat');
             $table->string('serv_received');
             $table->string('other_received');
             $table->string('freq_visit');
             $table->string('llin_recipient');
             $table->string('llin_where');
             $table->string('where_others');
             $table->string('llin_freq');
             $table->string('llin_sleep');
             $table->string('sleep_often');
             $table->string('why_no');
             $table->string('ipt_recipient');
             $table->string('freq_ipt');
             $table->string('given_sp');
             $table->string('sp_recipient');
             $table->string('sp_no');
             $table->string('why_others');
             $table->string('smc_recipient');
             $table->string('smc_age');
             $table->string('malaria');
             $table->string('mal_result');
             $table->string('tested_when');
             $table->string('act_recipient');
             $table->string('drug_received');
             $table->string('act_finish');
             $table->string('drug_finish_no');
             $table->string('rating');
             $table->string('dissatisfied');
             $table->string('others');
             $table->string('satisfied');
             $table->string('suggestion');
             $table->string('store_gps');
             $table->string('upload_image');
>>>>>>> parent of 4606fc2 (worked on kobo cei monthly count)
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
        Schema::dropIfExists('ceis');
    }
}
