<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('quizid')->unique();
            $table->string('instructorcourseid');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->date('date')->nullable();
            $table->string('url')->nullable();
            $table->string('question')->nullable();
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('quizzes');
    }
}
