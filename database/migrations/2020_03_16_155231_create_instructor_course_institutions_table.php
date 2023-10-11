<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorCourseInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_course_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('instructorcourseinstid')->unique();
            $table->string('instructorcourseid')->nullable();
            $table->string('institutionid')->nullable();

            $table->foreign('instructorcourseid')->references('instructorcourseid')->on('instructor_courses')->onDelete('cascade');
            $table->foreign('institutionid')->references('institutionid')->on('institutions')->onDelete('cascade');

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
        Schema::dropIfExists('instructor_course_institutions');
    }
}
