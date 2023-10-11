<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('infoid')->unique();
            $table->string('confirmation_token')->nullable();
            $table->string('profilepicurl')->nullable();
            $table->string('title')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('othername')->nullable();
            $table->string('gender')->nullable();
            $table->string('emailaddress')->nullable();
            $table->string('dob')->nullable();
            $table->string('homeaddress')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('primarycontact')->nullable();
            $table->string('auxiliarycontact')->nullable();
            $table->string('highestedulevel')->nullable();
            $table->string('highesteduinstitutionname')->nullable();

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
        Schema::dropIfExists('students');
    }
}
