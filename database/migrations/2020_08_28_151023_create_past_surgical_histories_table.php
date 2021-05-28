<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastSurgicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_surgical_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->integer('surgery_id')->unsigned()->index();
            $table->string('surgery_name');
            $table->integer('no_of_years')->nullable();
            $table->integer('year')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::table('past_surgical_histories', function(Blueprint $table) {
            $table->foreign('patient_visit_id')->references('id')->on('patient_visits')->onDelete('cascade');
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('surgery_id')->references('id')->on('surgeries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('past_surgical_histories');
    }
}
