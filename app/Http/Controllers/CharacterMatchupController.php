<?php

namespace App\Http\Controllers;

use App\Matches;
use App\User;
use Illuminate\Http\Request;
use Log;
use DB;

class MatchController extends Controller
{
    /**
     * All information about a character
     *
     * @return \Illuminate\Http\Response
     */
     public function character(){
         return view('matchups/character');
     }

     /**
      *
      *
      * @return \Illuminate\Http\Response
      */
      public function character_vs_character( $winner_character, $loser_character ){
         return view('matchups/character_vs_character');
      }
}
