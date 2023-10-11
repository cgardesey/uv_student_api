<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorPreferredTeachingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_preferred_teaching_times', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('teachingtimeid')->unique();
            $table->string('dow')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();

            $table->string('instructorid')->nullable();


            $table->foreign('instructorid')->references('infoid')->on('instructors')->onDelete('cascade');

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
        Schema::dropIfExists('instructor_preferred_teaching_times');
    }
}
