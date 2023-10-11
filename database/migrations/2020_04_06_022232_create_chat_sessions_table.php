<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('chatsessionid')->unique();
            $table->string('instructorcourseid')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('docurl')->nullable();
            $table->boolean('islive')->default(false);

            $table->foreign('instructorcourseid')->references('instructorcourseid')->on('instructor_courses')->onDelete('cascade');

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
        Schema::dropIfExists('chat_sessions');
    }
}
