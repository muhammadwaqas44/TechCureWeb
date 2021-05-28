<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientSpecialDosagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_special_dosages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_medication_id')->unsigned()->index();
            $table->string('dosage');
            $table->text('special_instructions')->nullable();
            $table->timestamps();
        });

        Schema::table('patient_special_dosages', function(Blueprint $table) {
            $table->foreign('patient_medication_id')->references('id')->on('patient_medications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_special_dosages');
    }
}
