<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatchController;
use App\Models\Matches;
use App\Models\Characters;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Log;

class HistoryController extends Controller
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
     * Show the history tab.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($playerId){
        $data = array();
        $player = User::find($playerId);
        $data['player'] = $player;

        $matches = Matches::userMatches($playerId);
        $data['matches'] = $matches;

        $characters = Characters::all();
        Log::info($characters);

        $charactersIdToName = array();
        foreach($characters as $character){
            $charactersIdToName[$character['id']] = $character['name'];
        }
        $data['characters'] = $charactersIdToName;

        return view('history', $data);
    }

	/**
	* Show the history tab for a player with no data
	*
	*/
	public function userIndex(){
		$playerId = Auth::user()->id;
		return $this->index($playerId);
	}
}
