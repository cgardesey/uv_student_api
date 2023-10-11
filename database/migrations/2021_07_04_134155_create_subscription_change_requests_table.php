<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_change_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('subscriptionchangerequestid')->unique();
            $table->string('studentid')->nullable();
            $table->string('institutionid')->nullable();
            $table->boolean('approved')->default(false);

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
        Schema::dropIfExists('subscription_change_requests');
    }
}
