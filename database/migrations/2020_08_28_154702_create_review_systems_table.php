<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->text('first_description')->nullable();
            $table->text('second_description')->nullable();
            $table->text('third_description')->nullable();
            $table->timestamps();
        });

        Schema::table('review_systems', function(Blueprint $table) {
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
        Schema::dropIfExists('review_systems');
    }
}
