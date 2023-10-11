<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProprietorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietors', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('userid')->unique();
            $table->string('phonenumber')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('confirmation_token')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token')->unique();
            $table->string('role');
            $table->integer('email_verified')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('connected')->default(false);
            $table->string('otp')->nullable();

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
        Schema::dropIfExists('proprietors');
    }
}
