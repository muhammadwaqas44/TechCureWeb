<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicConfigMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_config_medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_config_id')->unsigned()->index();
            $table->integer('medication_id')->unsigned()->index();
            $table->string('medication_name')->nullable();
            $table->timestamps();
        });
        Schema::create('clinic_config_medications', function (Blueprint $table) {
            $table->foreign('clinic_config_id')->references('id')->on('clinic_configs')->onDelete('cascade');
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
        Schema::dropIfExists('clinic_config_medications');
    }
}
