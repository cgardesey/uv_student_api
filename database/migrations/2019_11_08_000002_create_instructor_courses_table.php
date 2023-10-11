<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('instructorcourseid')->unique();
            $table->string('instructorid');
            $table->string('courseid');
            $table->string('institutionid')->nullable();
            $table->string('livestreamurl')->nullable();
            $table->string('currency')->nullable();
            $table->string('price')->default("0.00");
            $table->boolean('connectedtoaudio')->default(false);
            $table->boolean('connectedtovideo')->default(false);
            $table->boolean('connectedtocall')->default(false);

            $table->unique(['instructorid', 'courseid']);

            $table->foreign('instructorid')->references('infoid')->on('instructors')->onDelete('cascade');
            $table->foreign('courseid')->references('courseid')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('instructor_courses');
    }
}
