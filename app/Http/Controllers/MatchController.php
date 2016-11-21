<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\Matches;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Log;

class MatchController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
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
