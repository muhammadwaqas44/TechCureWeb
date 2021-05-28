<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalConfigSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_config_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_config_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->string('specialty_name')->nullable();
            $table->timestamps();
        });
        Schema::create('hospital_config_specialties', function (Blueprint $table) {
            $table->foreign('hospital_config_id')->references('id')->on('hospital_configs')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_config_specialties');
    }
}
