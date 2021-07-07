<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbos', function (Blueprint $table) {
            $table->id();
            $table->string('cbo_name');
            $table->string('email');
            $table->string('phone');
            $table->string('state');
            $table->string('lga');
            $table->string('contact_person');
            $table->string('date_of_engagement');
            $table->string('date_of_establishment');
            $table->string('physical_contact_address');
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
        Schema::dropIfExists('cbos');
    }
}
