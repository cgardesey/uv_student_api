<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuestionSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_question_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('studentid')->nullable();
            $table->string('sessionid')->unique();
            $table->string('actionid')->nullable();
            $table->timestamps();
            $table->string('questionid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_question_sessions');
    }
}
