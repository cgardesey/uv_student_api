<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorCourseRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_course_ratings', function (Blueprint $table) {

            $table->string('instructorcourseratingid')->unique();
            $table->string('studentid');
            $table->string('instructorcourseid');
            $table->boolean('onestar')->default(false);
            $table->boolean('twostar')->default(false);
            $table->boolean('threestar')->default(false);
            $table->boolean('fourstar')->default(false);
            $table->boolean('fivestar')->default(false);
            $table->string('review')->nullable();

            $table->unique(['studentid', 'instructorcourseid']);

            $table->foreign('studentid')->references('infoid')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('instructor_course_ratings');
    }
}
