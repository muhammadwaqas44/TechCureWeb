<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicConfigSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_config_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_config_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->string('specialty_name')->nullable();
            $table->timestamps();
        });
        Schema::create('clinic_config_specialties', function (Blueprint $table) {
            $table->foreign('clinic_config_id')->references('id')->on('clinic_configs')->onDelete('cascade');
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
        Schema::dropIfExists('clinic_config_specialties');
    }
}
