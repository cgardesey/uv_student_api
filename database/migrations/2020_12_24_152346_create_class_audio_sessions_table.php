<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAudioSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_audio_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('classaudiosessionid')->unique();
            $table->string('sessionid')->nullable();
            $table->string('instructorcourseid')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('streamurl')->nullable();
            $table->string('docurl')->nullable();
            $table->boolean('chatlocked')->default(true);

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
        Schema::dropIfExists('class_audio_sessions');
    }
}
