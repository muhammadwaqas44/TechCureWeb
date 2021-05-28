<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->nullable();
            $table->string('slug')->nullable();
            $table->integer('hospital_id')->unsigned()->index();
            $table->string('hospital_name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('hospital_configs', function (Blueprint $table) {
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_configs');
    }
}
