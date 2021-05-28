<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('message')->nullable();
            $table->integer('user_type');  // 1 = Patient | 2 = Practiotioner | 3 = Clinic | 4 = Admin
            $table->integer('user_id');
            $table->boolean('is_read')->default(0);  // 0 = Unread | 1 = Read
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
        Schema::dropIfExists('notifications');
    }
}
