<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('enrolmentid')->unique();
            $table->string('studentid');
            $table->string('instructorcourseid');
            $table->boolean('enrolled')->default(true);
            $table->date('feesexpirydate')->nullable();
            $table->integer('percentagecompleted')->default(0);
            $table->boolean('connectedtoaudio')->default(false);
            $table->boolean('connectedtovideo')->default(false);
            $table->boolean('connectedtocall')->default(false);
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
        Schema::dropIfExists('enrolments');
    }
}
