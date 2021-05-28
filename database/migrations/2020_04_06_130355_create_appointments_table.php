<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned()->index();
            $table->integer('patient_type_id')->unsigned()->index()->nullable();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->integer('clinic_id')->unsigned()->index();
            $table->date('date');
            $table->string('time_slot');
            $table->string('practitioner_url')->nullable();
            $table->string('patient_url')->nullable();
            $table->integer('type');  // 0 = Physical | 1 = Online
            $table->integer('status');  // 0 = Pending || 1 = Under Process | 2 = Accepted | 3 = Rejected | 4 = Check In | 5 = Completed
            $table->boolean('early_meeting')->default(0);  // 0 = on schedule | 1 = early start
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('appointments', function(Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('patient_type_id')->references('id')->on('patient_types')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
}
