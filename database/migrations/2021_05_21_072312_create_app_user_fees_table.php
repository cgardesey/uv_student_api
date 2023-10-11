<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUserFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_fees', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('appuserfeesid')->unique();
            $table->string('currency')->nullable();
            $table->string('priceperday')->nullable();
            $table->string('priceperweek')->nullable();
            $table->string('pricepermonth')->nullable();

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
        Schema::dropIfExists('app_user_fees');
    }
}
