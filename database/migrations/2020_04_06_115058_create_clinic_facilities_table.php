<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned()->index();
            $table->integer('facility_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('clinic_facilities', function(Blueprint $table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_facilities');
    }
}
