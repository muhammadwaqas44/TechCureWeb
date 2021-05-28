<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('practitioner_specialties', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
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
        Schema::dropIfExists('practitioner_specialties');
    }
}
