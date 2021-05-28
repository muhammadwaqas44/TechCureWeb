<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->integer('appointment_id')->unsigned()->index();
            $table->integer('visit_number');
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->string('total_duration')->nullable();
            $table->text('notes_internal')->nullable();
            $table->text('notes_printed')->nullable();
            $table->integer('revise_of')->nullable();
            $table->string('next_visit')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->string('pdf_report')->nullable();
            $table->boolean('status')->default(0);  // 0 = Not Revised | 1 = Revised
            $table->timestamps();
        });

        Schema::table('patient_visits', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_visits');
    }
}
