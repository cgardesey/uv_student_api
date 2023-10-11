<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorInstitutionsAttendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_institutions_attended', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('institutionattendedid')->unique();
            $table->string('institutionname')->nullable();
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
        Schema::dropIfExists('instructor_institutions_attended');
    }
}
