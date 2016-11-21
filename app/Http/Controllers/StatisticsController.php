<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\Characters;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
use DB;

class StatisticsController extends Controller
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
	* Gets matchup json for playerOne vs playerTwo
	* @return json
	*/
	public function playerVsPlayer($playerOne, $playerTwo){
		$wonMatches = Matches::where('winner', '=', $playerOne)
							->where('loser', '=',  $playerTwo)
							->get();

		$lostMatches = Matches::where('loser', '=',  $playerOne)
									->where('winner', '=',  $playerTwo)
									->get();

		$data = array();
		$data['matches'] = array_merge($data, $wonMatches->all(), $lostMatches->all());
		$data['won'] = $wonMatches->count();
		$data['lost'] = $lostMatches->count();

		return response()
			->json($data);
	}

	/**
	* Gets matchup json for playerOne vs playerTwo when player one is playing as player one character
	* @return json
	*/
	public function playerAsCharacterVsPlayer($playerOne, $playerTwo, $playerOneCharacter){
		$wonMatches = Matches::where('winner', '=', $playerOne)
							->where('loser', '=',  $playerTwo)
							->where('winner_character', '=', $playerOneCharacter)
							->get();

		$lostMatches = Matches::where('loser', '=',  $playerOne)
									->where('winner', '=',  $playerTwo)
									->where('loser_character', '=', $playerOneCharacter)
									->get();

		$data = array();
		$data['matches'] = array_merge($data, $wonMatches->all(), $lostMatches->all());
		$data['won'] = $wonMatches->count();
		$data['lost'] = $lostMatches->count();

		return response()
			->json($data);
	}

	/**
	* Gets matchup json for playerOne vs an opponent's character
	* @return json
	*/
	public function playerVsCharacter($playerOne, $opponentCharacter){
		$wonMatches = Matches::where('winner', '=', $playerOne)
							->where('loser_character', '=', $opponentCharacter)
							->get();

		$lostMatches = Matches::where('loser', '=',  $playerOne)
									->where('winner_character', '=', $opponentCharacter)
									->get();

		$data = array();
		$data['matches'] = array_merge($data, $wonMatches->all(), $lostMatches->all());
		$data['won'] = $wonMatches->count();
		$data['lost'] = $lostMatches->count();

		return response()
			->json($data);
	}

	/**
	* Gets player elo vs time
	* @return json
	*/
	public function playerVsPlayerElo($playerOne,$playerTwo,$dateRange){
		$wonMatches = Matches::where('winner', '=', $playerOne)
							->where('loser', '=',  $playerTwo)
							->get();

		$lostMatches = Matches::where('loser', '=',  $playerOne)
									->where('winner', '=',  $playerTwo)
									->get();

		$data = array();
		$matches = array_merge($data, $wonMatches->all(), $lostMatches->all());

		/*Do elo calculations*/

		return response()
			->json($data);
	}

	/**
	* Gets character vs character data
	* @return json
	*/
	public function characterVsCharacter($characterOne,$characterTwo){
		$wonMatches = Matches::where('winner_character', '=', $characterOne)
							->where('loser_character', '=',  $characterTwo)
							->get();

		$lostMatches = Matches::where('loser_character', '=',  $characterOne)
									->where('winner_character', '=',  $characterTwo)
									->get();

		$data = array();
		$data['matches'] = array_merge($data, $wonMatches->all(), $lostMatches->all());
		$data['won'] = $wonMatches->count();
		$data['lost'] = $lostMatches->count();

		return response()
			->json($data);
	}
}
