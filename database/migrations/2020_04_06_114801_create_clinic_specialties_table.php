<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('clinic_specialties', function(Blueprint $table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_specialties');
    }
}
