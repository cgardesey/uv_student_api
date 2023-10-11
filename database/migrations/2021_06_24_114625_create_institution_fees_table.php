<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_fees', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('institutionfeeid')->unique();
            $table->string('institutionid')->nullable();
            $table->string('fees_type')->nullable();
            $table->string('currency', 255)->nullable();
            $table->string('price_day')->nullable();
            $table->string('price_week')->nullable();
            $table->string('price')->nullable();
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('institution_fees');
    }
}
