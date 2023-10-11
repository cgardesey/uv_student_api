<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorCoursePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_course_periods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('instructorcourseperiodid')->unique();
            $table->string('instructorcourseid');
            $table->string('periodid');
            $table->unique(['instructorcourseid', 'periodid']);

            $table->foreign('instructorcourseid')->references('instructorcourseid')->on('instructor_courses')->onDelete('cascade');
            $table->foreign('periodid')->references('timetableid')->on('timetables')->onDelete('cascade');

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
        Schema::dropIfExists('instructor_course_periods');
    }
}
