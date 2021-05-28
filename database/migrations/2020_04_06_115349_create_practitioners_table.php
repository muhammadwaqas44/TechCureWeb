<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practitioners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->integer('qualification_id')->unsigned()->index()->nullable();
            $table->string('license_no')->nullable();
            $table->string('license_image')->nullable();
            $table->string('prescription_pad_header_image')->nullable();
            $table->string('prescription_pad_footer_image')->nullable();
            $table->string('prescription_pad_sidebar_image')->nullable();
            $table->string('prescription_pad_other_image')->nullable();
            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('practitioners', function(Blueprint $table) {
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practitioners');
    }
}
