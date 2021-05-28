<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalConfigMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_config_medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_config_id')->unsigned()->index();
            $table->integer('medication_id')->unsigned()->index();
            $table->string('medication_name')->nullable();
            $table->timestamps();
        });
        Schema::create('hospital_config_medications', function (Blueprint $table) {
            $table->foreign('hospital_config_id')->references('id')->on('hospital_configs')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_config_medications');
    }
}
