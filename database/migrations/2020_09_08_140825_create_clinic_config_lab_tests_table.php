<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicConfigLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_config_lab_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_config_id')->unsigned()->index();
            $table->integer('lab_test_id')->unsigned()->index();
            $table->string('lab_test_name')->nullable();
            $table->timestamps();
        });
        Schema::create('clinic_config_lab_tests', function (Blueprint $table) {
            $table->foreign('clinic_config_id')->references('id')->on('clinic_configs')->onDelete('cascade');
            $table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_config_lab_tests');
    }
}
