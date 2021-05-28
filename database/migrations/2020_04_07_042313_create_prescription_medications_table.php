<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_prescription_id')->unsigned()->index();
            $table->integer('medication_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('prescription_medications', function(Blueprint $table) {
            $table->foreign('patient_prescription_id')->references('id')->on('patient_prescriptions')->onDelete('cascade');
            $table->foreign('medication_id')->references('id')->on('medications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_medications');
    }
}
