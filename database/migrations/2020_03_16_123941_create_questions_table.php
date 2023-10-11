<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('questionid')->unique();
            $table->string('quizid');
            $table->string('url')->nullable();
            $table->longText('question')->nullable();
            $table->string('correctans', 255)->nullable();
            $table->string('optiona')->nullable();
            $table->string('optionb')->nullable();
            $table->string('optionc')->nullable();
            $table->string('optiond')->nullable();
            $table->string('optione')->nullable();

            $table->foreign('quizid')->references('quizid')->on('quizzes')->onDelete('cascade');

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
        Schema::dropIfExists('questions');
    }
}
