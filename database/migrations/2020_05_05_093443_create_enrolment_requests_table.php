<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolment_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('enrolmentrequestid')->unique();
            $table->string('studentid')->nullable();
            $table->string('instructorcourseid')->nullable();
            $table->boolean('approved')->default(false);

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
        Schema::dropIfExists('enrolment_requests');
    }
}
