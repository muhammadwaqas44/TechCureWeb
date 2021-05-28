<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->integer('lab_test_id')->unsigned()->index();
            $table->string('lab_test_name');
            $table->timestamps();
        });

        Schema::table('favourite_labs', function(Blueprint $table) {
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourite_labs');
    }
}
