<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\Characters;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Log;

class MatchupController extends Controller
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
}
