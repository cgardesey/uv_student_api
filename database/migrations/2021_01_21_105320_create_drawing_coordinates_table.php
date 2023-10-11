<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawingCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drawing_coordinates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('coordinatesid')->unique();
            $table->string('classsessionid')->nullable();
            $table->string('instructorcourseid');
            $table->string('x0')->nullable();
            $table->string('x1')->nullable();
            $table->string('y0')->nullable();
            $table->string('y1')->nullable();
            $table->string('color')->nullable();
            $table->string('strokeWidth')->nullable();
            $table->string('sessionId')->nullable();
            $table->string('clearpage')->nullable();
            $table->string('background')->nullable();
            $table->boolean('istreaming')->default(false);

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
        Schema::dropIfExists('drawing_coordinates');
    }
}
