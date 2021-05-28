<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('password');
            $table->string('from_day')->nullable();
            $table->string('to_day')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            $table->string('logo')->nullable();

            $table->boolean('all_day')->default(0); // 0 = selective days/time | 1 = 24/7

            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
