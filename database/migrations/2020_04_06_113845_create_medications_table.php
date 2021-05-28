<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->string('generic_name')->nullable();
            $table->integer('dose_id')->unsigned()->index();
            $table->string('dose');
            $table->integer('unit_id')->unsigned()->index();
            $table->string('unit');
            $table->integer('frequency_id')->unsigned()->index();
            $table->string('frequency');
            $table->integer('duration_id')->unsigned()->index();
            $table->string('duration');
            $table->integer('diagnosis_type_id')->unsigned()->index();
            $table->string('diagnosis_type');
            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('medications', function(Blueprint $table) {
            $table->foreign('dose_id')->references('id')->on('doses')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('frequency_id')->references('id')->on('frequencies')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->foreign('diagnosis_type_id')->references('id')->on('diagnosis_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
