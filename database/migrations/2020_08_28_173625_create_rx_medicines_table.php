<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRxMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rx_medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->integer('medicine_id')->unsigned()->index();
            $table->string('medicine_name');
            $table->integer('dose_id')->unsigned()->index()->nullable();
            $table->string('dose_name')->nullable();
            $table->integer('unit_id')->unsigned()->index()->nullable();
            $table->string('unit_name')->nullable();
            $table->integer('frequency_id')->unsigned()->index();
            $table->string('frequency_name');
            $table->integer('duration_id')->unsigned()->index();
            $table->string('duration_name');
            $table->integer('diagnosis_type_id')->unsigned()->index();
            $table->string('diagnosis_type_name');
            $table->timestamps();
        });

        Schema::table('rx_medicines', function(Blueprint $table) {
            $table->foreign('patient_visit_id')->references('id')->on('patient_visits')->onDelete('cascade');
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medications')->onDelete('cascade');
            $table->foreign('dose_id')->references('id')->on('doses')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('frequency_id')->references('id')->on('frequencies')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->foreign('diagnosis_type_id')->references('id')->on('diagnosis_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rx_medicines');
    }
}
