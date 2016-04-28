<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player1')->references('id')->on('users');
            $table->integer('player2')->references('id')->on('users');
            $table->string('player1Character');
            $table->string('player2Character');
            $table->integer('player1Stocks');
            $table->integer('player2Stocks');
            $table->string('stage');
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
        Schema::drop('match');
    }
}
