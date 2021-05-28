<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalConfigFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_config_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_config_id')->unsigned()->index();
            $table->integer('facility_id')->unsigned()->index();
            $table->string('facility_name')->nullable();
            $table->timestamps();
        });

        Schema::create('hospital_config_facilities', function (Blueprint $table) {
            $table->foreign('hospital_config_id')->references('id')->on('hospital_configs')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_config_facilities');
    }
}
