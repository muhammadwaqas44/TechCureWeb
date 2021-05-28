<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerClinicDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_clinic_days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day');
            $table->integer('practitioner_clinic_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('practitioner_clinic_days', function(Blueprint $table) {
            $table->foreign('practitioner_clinic_id')->references('id')->on('practitioner_clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practitioner_clinic_days');
    }
}
