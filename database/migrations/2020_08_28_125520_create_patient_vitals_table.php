<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_vitals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->integer('bp_sys')->nullable();
            $table->integer('bp_dias')->nullable();
            $table->integer('pulse')->nullable();
            $table->double('weight_lbs', 8, 2)->nullable();
            $table->double('weight_kgs', 8, 2)->nullable();
            $table->double('height_ft', 8, 2)->nullable();
            $table->double('height_in', 8, 2)->nullable();
            $table->double('height_cms', 8, 2)->nullable();
            $table->double('bmi', 8, 2)->nullable();
            $table->integer('bsf')->nullable();
            $table->integer('bsr')->nullable();
            $table->integer('bp_sys_2')->nullable();
            $table->integer('bp_dias_2')->nullable();
            $table->integer('pulse_2')->nullable();
            $table->double('weight_lbs_2', 8, 2)->nullable();
            $table->double('weight_kgs_2', 8, 2)->nullable();
            $table->double('height_ft_2', 8, 2)->nullable();
            $table->double('height_in_2', 8, 2)->nullable();
            $table->double('height_cms_2', 8, 2)->nullable();
            $table->double('bmi_2', 8, 2)->nullable();
            $table->integer('bsf_2')->nullable();
            $table->integer('bsr_2')->nullable();
            $table->timestamps();
        });

        Schema::table('patient_vitals', function(Blueprint $table) {
            $table->foreign('patient_visit_id')->references('id')->on('patient_visits')->onDelete('cascade');
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_vitals');
    }
}
