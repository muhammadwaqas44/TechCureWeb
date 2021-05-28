<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->nullable();
            $table->string('slug')->nullable();
            $table->integer('clinic_id')->unsigned()->index();
            $table->string('clinic_name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('clinic_configs', function (Blueprint $table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_configs');
    }
}
