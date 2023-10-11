<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('studentid')->unique();
            $table->string('sessionid')->nullable();
            $table->string('actionid')->nullable();
            $table->string('questionid')->nullable();

            $table->foreign('questionid')->references('questionid')->on('questions')->onDelete('cascade');

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
        Schema::dropIfExists('student_questions');
    }
}
