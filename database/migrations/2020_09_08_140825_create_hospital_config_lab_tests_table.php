<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalConfigLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_config_lab_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_config_id')->unsigned()->index();
            $table->integer('lab_test_id')->unsigned()->index();
            $table->string('lab_test_name')->nullable();
            $table->timestamps();
        });
        Schema::create('hospital_config_lab_tests', function (Blueprint $table) {
            $table->foreign('hospital_config_id')->references('id')->on('hospital_configs')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_config_lab_tests');
    }
}
