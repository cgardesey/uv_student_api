<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('groupsessionid')->unique();
            $table->string('groupid')->nullable();
            $table->string('title')->nullable();
            $table->string('docurl')->nullable();
            $table->string('roomid')->nullable();
            $table->string('dialcode')->nullable();

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
        Schema::dropIfExists('group_sessions');
    }
}
