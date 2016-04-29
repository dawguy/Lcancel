<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterMatchupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_matchups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character')->references('id')->on('characters');
            $table->integer('opponent_character')->references('id')->on('characters');
            $table->integer('wins');
            $table->integer('losses');
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
        Schema::drop('character_matchups');
    }
}
