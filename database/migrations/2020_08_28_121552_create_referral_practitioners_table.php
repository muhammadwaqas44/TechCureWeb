<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralPractitionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_practitioners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('hospital')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->integer('qualification_id')->unsigned()->index()->nullable();
            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->timestamps();
        });

        
        Schema::table('referral_practitioners', function(Blueprint $table) {
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
        Schema::dropIfExists('referral_practitioners');
    }
}
