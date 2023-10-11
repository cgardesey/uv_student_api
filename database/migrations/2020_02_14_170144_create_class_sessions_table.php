    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *+++++++++
     * @return void
     */
    public function up()
    {
        Schema::create('class_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('classsessionid')->unique();
            $table->string('sessionid')->nullable();
            $table->string('instructorcourseid');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('docurl')->nullable();
            $table->string('dialcode')->nullable();
            $table->string('roomid')->nullable();
            $table->boolean('islive')->default(false);

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
        Schema::dropIfExists('class_sessions');
    }
}
