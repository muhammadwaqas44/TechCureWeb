<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioner_assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assistant_id')->unsigned()->index();
            $table->integer('practitioner_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('practitioner_assistants', function(Blueprint $table) {
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade');
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
        Schema::dropIfExists('practitioner_assistants');
    }
}
