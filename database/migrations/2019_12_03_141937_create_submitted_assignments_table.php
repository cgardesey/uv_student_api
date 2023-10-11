<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_assignments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('submittedassignmentid')->unique();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->integer('percentagescore')->default(0);
            $table->string('assignmentid');
            $table->string('studentid');

            $table->foreign('assignmentid')->references('assignmentid')->on('assignments')->onDelete('cascade');
            $table->foreign('studentid')->references('infoid')->on('students')->onDelete('cascade');

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
        Schema::dropIfExists('submitted_assignments');
    }
}
