<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInstitutionLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_institution_logins', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('studentinstitutionloginid')->unique();
            $table->string('studentno')->nullable();
            $table->string('password')->nullable();
            $table->string('institutionid')->nullable();
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('student_institution_logins');
    }
}
