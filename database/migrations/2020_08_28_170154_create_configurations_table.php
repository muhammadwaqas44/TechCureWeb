<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('practitioner_id')->unsigned()->index();
            $table->string('practitioner_name');
            $table->enum('report_language', ['Both', 'English', 'Urdu'])->default('English');
            // generic_medicine => 1 for Yes, 0 for No
            $table->boolean('generic_medicine')->default(0);
            // print_option => 1 for Print on Letterhead, 0 for Print without Letterhead
            $table->boolean('print_option')->default(0);
            // signature_option => 1 for Show Signature, 0 for Hide Signature
            $table->boolean('signature_option')->default(0);
            $table->timestamps();
        });

        Schema::table('configurations', function(Blueprint $table) {
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
        Schema::dropIfExists('configurations');
    }
}
