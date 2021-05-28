<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assistant_id')->unsigned()->index();
            $table->integer('specialty_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('assistant_specialties', function(Blueprint $table) {
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistant_specialties');
    }
}
