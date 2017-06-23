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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Matches that have recently been played.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		$matches = Matches::orderBy('id','desc')->with('winner')->with('loser')->with('winner_character')->with('loser_character')->simplePaginate(50);
		Log::info($matches);
        return view('matches.index', compact('matches'));
    }

	/**
	* Shows the match input screen.
	* @return \Illuminate\Http\Response
	*/
	public function newMatchIndex(){
		$data = array();
        return view('new_match', $data);
	}


    /**
    * Creates a new match.
    */
    public function putMatch(Request $request){
        $player1 = $request->get('player1');
        $player2 = $request->get('player2');
        $stage = $request->get('stage');
        $winner = null;
        $loser = null;

        if($player1['stocks'] >= $player2['stocks']){
            $winner = $player1;
            $loser = $player2;
        }
        else{
            $loser = $player1;
            $winner = $player2;
        }

				//I should add a addedBy playerId column to this table
        $match = new Matches;
        $match->winner = $winner['playerId'];
        $match->loser = $loser['playerId'];
        $match->winner_character = $winner['character'];
        $match->loser_character = $loser['character'];
        $match->winner_stocks = $winner['stocks'];
        $match->loser_stocks = $loser['stocks'];
        $match->stage = $stage;

        $match->save();

    }
}
