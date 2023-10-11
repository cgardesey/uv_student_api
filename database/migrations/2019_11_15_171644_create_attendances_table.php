<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('attendanceid')->unique();
            $table->string('sessionid')->nullable();
            $table->string('audioid')->nullable();
            $table->string('type')->nullable();
            $table->integer('duration')->default(0);
            $table->string('studentid');

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
        Schema::dropIfExists('attendances');
    }
}
