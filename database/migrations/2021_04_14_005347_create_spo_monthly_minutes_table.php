<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpoMonthlyMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spo_monthly_minutes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state');
            $table->string('date_of_meeting');
            $table->string('attachment');
            $table->longText('minutes_of_meeting');
            $table->string('month');
            $table->string('year');
            $table->string('quarter');
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
        Schema::dropIfExists('spo_monthly_minutes');
    }
}
