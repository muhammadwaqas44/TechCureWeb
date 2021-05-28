<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_allergies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_prescription_id')->unsigned()->index();
            $table->integer('allergy_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('prescription_allergies', function(Blueprint $table) {
            $table->foreign('patient_prescription_id')->references('id')->on('patient_prescriptions')->onDelete('cascade');
            $table->foreign('allergy_id')->references('id')->on('allergies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_allergies');
    }
}
