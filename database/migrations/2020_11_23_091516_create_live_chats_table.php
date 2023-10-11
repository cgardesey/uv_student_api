<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_chats', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('livechatid')->unique();
            $table->string('livechatrefid')->nullable();
            $table->string('tempid')->nullable();
            $table->string('text')->nullable();
            $table->string('link')->nullable();
            $table->string('linktitle')->nullable();
            $table->string('linkdescription')->nullable();
            $table->string('linkimage')->nullable();
            $table->string('attachmenturl')->nullable();
            $table->string('attachmenttype')->nullable();
            $table->string('attachmenttitle')->nullable();
            $table->boolean('readbyrecepient')->default(false);
            $table->string('instructorcourseid');
            $table->string('senderid');
            $table->string('recepientid')->nullable();

            $table->foreign('instructorcourseid')->references('instructorcourseid')->on('instructor_courses')->onDelete('cascade');
            $table->foreign('senderid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('recepientid')->references('userid')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('live_chats');
    }
}
