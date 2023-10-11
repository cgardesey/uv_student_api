<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordedVideoStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorded_video_streams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('recordedvideostreamid')->unique();
            $table->string('sessionid');
            $table->string('instructorcourseid');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('docurl')->nullable();
            $table->string('url')->nullable();
            $table->string('giflink')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('recorded_video_streams');
    }
}
