<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientVisitPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visit_prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->text('prescription');
            $table->timestamps();
        });

        Schema::table('patient_visit_prescriptions', function(Blueprint $table) {
            $table->foreign('patient_visit_id')->references('id')->on('patient_visits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_visit_prescriptions');
    }
}
