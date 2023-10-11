<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('institutionid')->unique();
            $table->string('name')->nullable();
            $table->string('level')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('contact')->nullable();
            $table->string('website')->nullable();
            $table->string('logourl')->nullable();
            $table->string('dateregistered')->nullable();
            $table->string('userid')->nullable();
            $table->boolean('active')->default(true);

            $table->foreign('userid')->references('userid')->on('proprietors')->onDelete('cascade');

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
        Schema::dropIfExists('institutions');
    }
}
