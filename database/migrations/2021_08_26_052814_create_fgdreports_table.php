<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFgdreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fgdreports', function (Blueprint $table) {
            $table->id();
            $table->string('cbo_name');
            $table->string('state');
            $table->string('lga');
            $table->string('email');
            $table->string('date_of_activity');
            $table->string('attachment');
            $table->string('month');
            $table->string('year');
            $table->string('quarter');
            $table->string('activity');
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
        Schema::dropIfExists('fgdreports');
    }
}
