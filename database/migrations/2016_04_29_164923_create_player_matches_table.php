<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player')->references('id')->on('users');
            $table->integer('opponent')->references('id')->on('users');
            $table->integer('match')->references('id')->on('matches');
            $table->boolean('player_wins');
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
        Schema::drop('player_matches');
    }
}
