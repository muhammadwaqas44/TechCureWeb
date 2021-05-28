<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adrs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_visit_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('patient_id')->unsigned()->index();
            $table->string('patient_name');
            $table->integer('drug_id')->unsigned()->index();
            $table->string('drug_name');
            $table->integer('reaction_id')->unsigned()->index()->nullable();
            $table->string('reaction_name')->nullable();
            $table->timestamps();
        });

        Schema::table('adrs', function(Blueprint $table) {
            $table->foreign('patient_visit_id')->references('id')->on('patient_visits')->onDelete('cascade');
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->foreign('reaction_id')->references('id')->on('reactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adrs');
    }
}
