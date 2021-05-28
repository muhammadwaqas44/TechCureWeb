<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->boolean('fasting')->default(0); // 1 = Fasting | 0 != Fasting
            $table->text('instructions')->nullable();
            $table->integer('lab_id')->unsigned()->index()->nullable();
            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_tests');
    }
}
