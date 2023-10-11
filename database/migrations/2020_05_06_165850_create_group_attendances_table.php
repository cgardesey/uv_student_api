<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('attendanceid')->unique();
            $table->string('groupid')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('duration')->nullable();
            $table->string('audioid')->nullable();

            $table->foreign('audioid')->references('audioid')->on('audio')->onDelete('cascade');

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
        Schema::dropIfExists('group_attendances');
    }
}
