<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmokingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smoking_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->boolean('ever_smoke')->default(0);
            $table->boolean('still_smoke')->default(0);
            $table->integer('no_of_years')->nullable();
            $table->integer('cig_per_day')->nullable();
            $table->boolean('ever_drink')->default(0);
            $table->boolean('still_drink')->default(0);
            $table->text('drink_remarks')->nullable();
            $table->boolean('ever_use_drugs')->default(0);
            $table->boolean('still_use_drugs')->default(0);
            $table->string('what_drug_use')->nullable();
            $table->string('how_use_drug')->nullable();
            $table->timestamps();
        });

        Schema::table('smoking_histories', function(Blueprint $table) {
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
        Schema::dropIfExists('smoking_histories');
    }
}
