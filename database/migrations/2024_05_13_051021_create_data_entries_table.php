<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_entries', function (Blueprint $table) {
            $table->id();
            $table->string('_id')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->date('today')->nullable();
            $table->string('consent')->nullable();
            $table->string('service_cat')->nullable();
            $table->string('serv_received')->nullable();
            $table->string('other_received')->nullable();
            $table->string('freq_visit')->nullable();
            $table->string('year')->nullable();
            $table->string('qtr')->nullable();
            $table->string('month')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('cbo')->nullable();
            $table->string('cboemail')->nullable();
            $table->string('ward')->nullable();
            $table->string('hf')->nullable();
            $table->string('resp_name')->nullable();
            $table->string('child_name')->nullable();
            $table->string('resp_cat')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('resp_edu')->nullable();
            $table->string('mal_info')->nullable();
            $table->string('info_source')->nullable();
            $table->string('prev_how')->nullable();
            $table->string('given_med')->nullable();
            $table->string('side_effect')->nullable();
            $table->string('access_hf')->nullable();
            $table->string('attended_by_hf')->nullable();
            $table->string('offer_anc')->nullable();
            $table->string('receive_ipt')->nullable();
            $table->string('free_mal_aware')->nullable();
            $table->string('denied_access')->nullable();
            $table->string('payto_receive')->nullable();
            $table->string('tested')->nullable();
            $table->string('result_tested')->nullable();
            $table->string('given_meds')->nullable();
            $table->string('duration')->nullable();
            $table->string('attitude')->nullable();
            $table->string('gender_hw')->nullable();
            $table->string('comf')->nullable();
            $table->string('descrimination')->nullable();
            $table->string('assess_quality')->nullable();
            $table->string('hw_qty')->nullable();
            $table->string('hiv_info')->nullable();
            $table->string('infohiv_source')->nullable();
            $table->string('hiv_prev')->nullable();
            $table->string('hivmed_given')->nullable();
            $table->string('hivdrug_side')->nullable();
            $table->string('easilyto_hf')->nullable();
            $table->string('attendedby_hf')->nullable();
            $table->string('ancservice')->nullable();
            $table->string('hivaids_aware')->nullable();
            $table->string('deniedhiv_serv')->nullable();
            $table->string('kindofserv')->nullable();
            $table->string('hivduration')->nullable();
            $table->string('hivattitude')->nullable();
            $table->string('hivgender_hw')->nullable();
            $table->string('hivcomf')->nullable();
            $table->string('hivdescrimination')->nullable();
            $table->string('hivassess_quality')->nullable();
            $table->string('hivhw_qty')->nullable();
            $table->string('tb_info')->nullable();
            $table->string('tb_source')->nullable();
            $table->string('prev_tb')->nullable();
            $table->string('tbdrug_given')->nullable();
            $table->string('drug_sideeffect')->nullable();
            $table->string('tbsideeffect_exp')->nullable();
            $table->string('tbaccess_hf')->nullable();
            $table->string('tbhw')->nullable();
            $table->string('tbanc')->nullable();
            $table->string('freetbaware')->nullable();
            $table->string('tbservdeny')->nullable();
            $table->string('kindtbserv')->nullable();
            $table->string('paytbserv')->nullable();
            $table->string('tbduration')->nullable();
            $table->string('tbattitude')->nullable();
            $table->string('tbgender_hw')->nullable();
            $table->string('tbcomf')->nullable();
            $table->string('tbdescrimination')->nullable();
            $table->string('tbassess_quality')->nullable();
            $table->string('tbhw_qty')->nullable();
            $table->string('store_gps')->nullable();
            $table->dateTime('_submission_time')->nullable();
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
        Schema::dropIfExists('data_entries');
    }
}
