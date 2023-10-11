<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('courseid')->unique();
            $table->string('imageurl')->nullable();
            $table->string('coursecode')->nullable();
            $table->string('coursepath', 255)->nullable();
            $table->string('description')->nullable();
            $table->string('about')->nullable();
            $table->boolean('active')->default(true);
//            $table->unique(['coursecode', 'coursepath']);

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
        Schema::dropIfExists('courses');
    }
}
