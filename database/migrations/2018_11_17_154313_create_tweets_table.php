<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('message');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        /**
         * $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('tweet_id');
            $table->text('message');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tweet_id')->references('id')->on('tweets');
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
