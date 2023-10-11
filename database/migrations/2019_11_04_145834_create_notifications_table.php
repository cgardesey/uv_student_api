<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');

            $table->string('notificationid')->unique();
            $table->string('text')->nullable();
            $table->boolean('readbyrecepient')->default(false);
            $table->string('senderid')->nullable();
//            $table->string('recepientid')->unique()->nullable();

            $table->foreign('senderid')->references('userid')->on('users')->onDelete('cascade');
//            $table->foreign('recepientid')->references('userid')->on('users')->onDelete('cascade');

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
