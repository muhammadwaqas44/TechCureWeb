<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mr_number')->unique();
            $table->integer('patient_type_id')->unsigned()->index()->nullable();
            $table->string('patient_type_title')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->integer('gender')->nullable(); // 1 = Male | 2 = Female | 3 = Other
            $table->string('password');
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->double('weight_kgs', 8, 2)->nullable();
            $table->double('weight_lbs', 8, 2)->nullable();
            $table->double('height_ft', 8, 2)->nullable();
            $table->double('height_in', 8, 2)->nullable();
            $table->double('height_cms', 8, 2)->nullable();
            $table->enum('marital_status', ['Single', 'Married'])->default('Single');
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->boolean('hospitalization')->default(0); // 0 = No | 1 = Yes
            $table->boolean('currently_on_drug')->default(0); // 0 = No | 1 = Yes
            $table->boolean('time_waste_flag_condition')->default(0);
            $table->boolean('critical_flag_condition')->default(0);
            $table->boolean('status')->default(1);  // 0 = InActive | 1 = Active
            $table->string('last_login', 256)->nullable();
            $table->string('token', 256)->nullable();
            $table->string('device_type',50)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('patients', function(Blueprint $table) {
            $table->foreign('patient_type_id')->references('id')->on('patient_types')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
