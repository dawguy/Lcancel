<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
                DB::table('characters')->insert(array(
                    array('name' => 'Bowser'),
                    array('name' => 'Captain Falcon'),
                    array('name' => 'Donkey Kong'),
                    array('name' => 'Dr. Mario'),
                    array('name' => 'Falco'),
                    array('name' => 'Fox'),
                    array('name' => 'Game And Watch'),
                    array('name' => 'Ganondorf'),
                    array('name' => 'Ice Climbers'),
                    array('name' => 'Jigglypuff'),
                    array('name' => 'Kirby'),
                    array('name' => 'Link'),
                    array('name' => 'Luigi'),
                    array('name' => 'Mario'),
                    array('name' => 'Marth'),
                    array('name' => 'Mewtwo'),
                    array('name' => 'Ness'),
                    array('name' => 'Peach'),
                    array('name' => 'Pichu'),
                    array('name' => 'Pikachu'),
                    array('name' => 'Roy'),
                    array('name' => 'Samus'),
                    array('name' => 'Sheik'),
                    array('name' => 'Yoshi'),
                    array('name' => 'Young Link'),
                    array('name' => 'Zelda'),
                    array('name' => 'Random')
                ));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            
        });
    }
}
