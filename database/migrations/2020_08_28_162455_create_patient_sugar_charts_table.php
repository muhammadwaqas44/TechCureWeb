<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientSugarChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_sugar_charts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->boolean('day_1_before_breakfast')->default(0);
            $table->boolean('day_1_2_hours_after_breakfast')->default(0);
            $table->boolean('day_1_before_lunch')->default(0);
            $table->boolean('day_1_2_hours_after_lunch')->default(0);
            $table->boolean('day_1_before_dinner')->default(0);
            $table->boolean('day_1_2_hours_after_dinner')->default(0);
            $table->boolean('day_1_bed_time')->default(0);
            $table->boolean('day_1_at_3_am')->default(0);
            $table->boolean('day_2_before_breakfast')->default(0);
            $table->boolean('day_2_2_hours_after_breakfast')->default(0);
            $table->boolean('day_2_before_lunch')->default(0);
            $table->boolean('day_2_2_hours_after_lunch')->default(0);
            $table->boolean('day_2_before_dinner')->default(0);
            $table->boolean('day_2_2_hours_after_dinner')->default(0);
            $table->boolean('day_2_bed_time')->default(0);
            $table->boolean('day_2_at_3_am')->default(0);
            $table->boolean('day_3_before_breakfast')->default(0);
            $table->boolean('day_3_2_hours_after_breakfast')->default(0);
            $table->boolean('day_3_before_lunch')->default(0);
            $table->boolean('day_3_2_hours_after_lunch')->default(0);
            $table->boolean('day_3_before_dinner')->default(0);
            $table->boolean('day_3_2_hours_after_dinner')->default(0);
            $table->boolean('day_3_bed_time')->default(0);
            $table->boolean('day_3_at_3_am')->default(0);
            $table->boolean('day_4_before_breakfast')->default(0);
            $table->boolean('day_4_2_hours_after_breakfast')->default(0);
            $table->boolean('day_4_before_lunch')->default(0);
            $table->boolean('day_4_2_hours_after_lunch')->default(0);
            $table->boolean('day_4_before_dinner')->default(0);
            $table->boolean('day_4_2_hours_after_dinner')->default(0);
            $table->boolean('day_4_bed_time')->default(0);
            $table->boolean('day_4_at_3_am')->default(0);
            $table->boolean('day_5_before_breakfast')->default(0);
            $table->boolean('day_5_2_hours_after_breakfast')->default(0);
            $table->boolean('day_5_before_lunch')->default(0);
            $table->boolean('day_5_2_hours_after_lunch')->default(0);
            $table->boolean('day_5_before_dinner')->default(0);
            $table->boolean('day_5_2_hours_after_dinner')->default(0);
            $table->boolean('day_5_bed_time')->default(0);
            $table->boolean('day_5_at_3_am')->default(0);
            $table->boolean('day_6_before_breakfast')->default(0);
            $table->boolean('day_6_2_hours_after_breakfast')->default(0);
            $table->boolean('day_6_before_lunch')->default(0);
            $table->boolean('day_6_2_hours_after_lunch')->default(0);
            $table->boolean('day_6_before_dinner')->default(0);
            $table->boolean('day_6_2_hours_after_dinner')->default(0);
            $table->boolean('day_6_bed_time')->default(0);
            $table->boolean('day_6_at_3_am')->default(0);
            $table->boolean('day_7_before_breakfast')->default(0);
            $table->boolean('day_7_2_hours_after_breakfast')->default(0);
            $table->boolean('day_7_before_lunch')->default(0);
            $table->boolean('day_7_2_hours_after_lunch')->default(0);
            $table->boolean('day_7_before_dinner')->default(0);
            $table->boolean('day_7_2_hours_after_dinner')->default(0);
            $table->boolean('day_7_bed_time')->default(0);
            $table->boolean('day_7_at_3_am')->default(0);
            $table->timestamps();
        });

        Schema::table('patient_sugar_charts', function(Blueprint $table) {
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
        Schema::dropIfExists('patient_sugar_charts');
    }
}
