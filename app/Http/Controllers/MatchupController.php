<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Matches;
use App\Repositories\DbCharacterMatchupRepository;
use App\Characters;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Log;
use DB;

class MatchupController extends Controller
{
	protected $character_matchup;
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DbCharacterMatchupRepository $character_matchup)
    {
		$this->character_matchup = $character_matchup;
    }

    /**
     * Show the matchup tab.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		$playerId = Auth::user()->id;
        $data = array();
        $player = User::find($playerId);
        $data['player'] = $player;

        $matches = Matches::userMatches($playerId);
        $data['matches'] = $matches;

        $characters = Characters::all();

        $charactersIdToName = array();
        foreach($characters as $character){
            $charactersIdToName[$character['id']] = $character['name'];
        }
        $data['characters'] = $charactersIdToName;

        return view('matchup', $data);
    }

	/**
	* Show the character's profile and statistics
	*
	* @return \Illuminate\Http\Response
	*/
	public function character($character){
		$data = $this->character_matchup->getAll($character);

		return view('matchups.character', $data);
	}

	/**
	* Show the character vs character stats
	*
	* @return \Illuminate\Http\Response
	*/
	public function character_matchup($first_character,$second_character)
	{
		$data = array();
		$matches = $this->character_matchup->getAllByCharacterMatchup($first_character,$second_character);
		$data['matches'] = $matches;
		return view('matchups.character_matchup', $data);
	}

	/**
	* Show the player vs player stats
	*
	* @return \Illuminate\Http\Response
	*/
	public function player_matchup($first_player,$second_player)
	{
		$data = array();
		$matches = $this->character_matchup->getAllByPlayerMatchup($first_player,$second_player);
		$data['matches'] = $matches;
		return view('matchups.player_matchup', $data);
	}

	/**
	* Show the player vs player stats with selected characters defaulted
	*
	* @return \Illuminate\Http\Response
	*/
	public function player_matchup_with_selected_character($first_player,$second_player,$first_character,$second_character)
	{
		$data = array();
		$matches = $this->character_matchup->getAllByPlayerMatchup($first_player,$second_player);
		$data['matches'] = $matches;
		$data['first_player_character'] = $first_character;
		$data['second_player_character'] = $second_character;
		return view('matchups.player_matchup', $data);
	}

	/**
	* Show the player record tree matchup
	*
	* @return \Illuminate\Http\Response
	*/
	public function playerRecordTreemap($playerOne, $playerTwo){
		$data['playerOne'] = $playerOne;
		$data['playerTwo'] = $playerTwo;
		return view('playerMatchupTreemap', $data);
	}

	/**
	* Gets matchup json for playerOne vs playerTwo
	* @return json
	*/
	public function playerRecordVsPlayer($playerOne, $playerTwo){
		$characters = Characters::all();
        $charactersIdToName = array();
        foreach($characters as $character){
            $charactersIdToName[$character['id']] = $character['name'];
        }

		$wonMatches = Matches::where('winner', '=', $playerOne)
							->where('loser', '=',  $playerTwo)
							->groupBy('loser_character')
							->select('loser_character', DB::raw('count(*) as total'))
							->get();

		$lostMatches = Matches::where('loser', '=',  $playerOne)
									->where('winner', '=',  $playerTwo)
									->groupBy('winner_character')
									->select('winner_character', DB::raw('count(*) as total'))
									->get();

		$matchJson = array();

		foreach($wonMatches as $match){
			$characterName = $charactersIdToName[$match['loser_character']];

			if(!isset($matchJson[$characterName])){
				$matchJson[$characterName] = array();
				$matchJson[$characterName]['id'] = $characterName;
				$matchJson[$characterName]['total'] = $match['total'];
				$matchJson[$characterName]['wins'] = $match['total'];
				$matchJson[$characterName]['parent'] = 'characters';
				$matchJson[$characterName]['losses'] = 0;
			} else {
				$matchJson[$characterName]['total'] += $match['total'];
				$matchJson[$characterName]['wins'] += $match['total'];
			}
		}

		foreach($lostMatches as $match){
			$characterName = $charactersIdToName[$match['winner_character']];

			if(!isset($matchJson[$characterName])){
				$matchJson[$characterName] = array();
				$matchJson[$characterName]['id'] = $characterName;
				$matchJson[$characterName]['total'] = $match['total'];
				$matchJson[$characterName]['wins'] = 0;
				$matchJson[$characterName]['parent'] = 'characters';
				$matchJson[$characterName]['losses'] = $match['total'];
			} else {
				$matchJson[$characterName]['total'] += $match['total'];
				$matchJson[$characterName]['losses'] += $match['total'];
			}
		}

		$matchJson = array_values($matchJson);
		$return_json = array();
		$return_json['id'] = "characters";
		$return_json['parent'] = null;
		$return_json['children'] = $matchJson;

		return response()
			->json($return_json);
	}

}
