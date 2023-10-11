<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('questionid', 255)->unique();
            $table->string('question', 255)->nullable();
            $table->longText('picture');
            $table->string('videopath', 255)->nullable();
            $table->string('answer')->nullable();
            $table->boolean('isfirstquestion')->default(false);
            $table->boolean('islastquestion')->default(false);
            $table->boolean('ismcq')->default(false);
            $table->boolean('isfirstmcq')->default(false);
            $table->boolean('islastmcq')->default(false);
            $table->boolean('isendofquestion')->default(false);

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
        Schema::dropIfExists('past_questions');
    }
}
