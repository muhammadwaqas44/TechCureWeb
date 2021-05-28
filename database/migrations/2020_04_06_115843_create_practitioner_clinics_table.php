<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->integer('clinic_id')->unsigned()->index();
            // $table->string('from_day')->nullable();
            // $table->string('to_day')->nullable();
            
            $table->integer('physical_fee')->nullable();
            $table->integer('online_fee')->nullable();

            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->timestamps();
        });

        Schema::table('practitioner_clinics', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practitioner_clinics');
    }
}
