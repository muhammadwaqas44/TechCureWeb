<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_lab_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->integer('lab_test_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('practitioner_lab_tests', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
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
        Schema::dropIfExists('practitioner_lab_tests');
    }
}
