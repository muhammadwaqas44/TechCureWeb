<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('practitioner_days', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practitioner_days');
    }
}
