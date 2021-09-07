<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemedialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remedial', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('ward');
            $table->string('cbo');
            $table->string('date_visit');
            $table->string('tracker_type');
            $table->string('identified_issues');
            $table->string('root_cause');
            $table->string('action_taken_immediately');
            $table->string('resolved');
            $table->string('follow_up_action');
            $table->string('responsibility');
            $table->string('timeline');
            $table->string('signed_document');
            $table->string('month');
            $table->string('year');
            $table->string('quarter');
            $table->string('cbo_name');
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
        Schema::dropIfExists('remedial');
    }
}
