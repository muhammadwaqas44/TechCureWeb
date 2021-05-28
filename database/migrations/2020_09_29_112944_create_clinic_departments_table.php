<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned()->index();
            $table->integer('department_id')->unsigned()->index();
            $table->string('department_name')->nullable();
            $table->timestamps();
        });

        Schema::table('clinic_departments', function(Blueprint $table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_departments');
    }
}
