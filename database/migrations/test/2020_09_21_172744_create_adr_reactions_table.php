<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdrReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adr_reactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adr_id')->unsigned()->index();
            $table->integer('reaction_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::create('adr_reactions', function (Blueprint $table) {
            $table->foreign('adr_id')->references('id')->on('adrs')->onDelete('cascade');
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
        Schema::dropIfExists('adr_reactions');
    }
}
