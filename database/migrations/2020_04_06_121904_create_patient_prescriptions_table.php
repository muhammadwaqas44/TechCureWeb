<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('illness_history')->nullable();
            $table->text('vital_assessments')->nullable();
            $table->text('clinical_examinations')->nullable();
            $table->text('presenting_complaints')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('investigations')->nullable();
            $table->text('family_history')->nullable();
            $table->text('referral')->nullable();
            $table->date('follow_up')->nullable();
            $table->integer('patient_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->integer('clinic_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('patient_prescriptions', function(Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('patient_prescriptions');
    }
}
