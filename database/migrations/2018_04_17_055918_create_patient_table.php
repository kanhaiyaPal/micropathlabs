<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctor_name',255);
            $table->string('salutation',50);
            $table->string('name',255);
            $table->string('gender',50);
            $table->integer('age');
            $table->string('vial_id',100);
            $table->string('mobile',100);
            $table->text('medical_history');
            $table->string('registration_no',100);
            $table->integer('center_id');
            $table->timestamps();

            $table->unique('registration_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
