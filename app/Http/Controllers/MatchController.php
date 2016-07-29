<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $searches = array();
        $friends = array();
        $recents = array();

        $user = Auth::user()->name;

        $searchable_users = User::searchable('');
        foreach($searchable_users as $user){
            $searches[] = ['name' => $user->name, 'id' => $user->id];
        }

        $friendly_users = User::friendsWith();

        foreach($friendly_users as $user){
            $friends[] = ['name' => $user->name, 'id' => $user->id];
        }

        $recently_played_with_users = User::recentlyPlayedWith();
        foreach($recently_played_with_users as $user){
            $recents[] = ['name' => $user->name, 'id' => $user->id];
        }

        $main_character = 'Peach';

        $data['friends']= $friends;
        $data['recents']= $recents;
        $data['searches']= $searches;
        $data['user'] = $user->name;
        $data['player1Character'] = 1;
        $data['main_character'] = $main_character;

        return view('new_match', $data);
    }

    public function putMatch(Request $request){
        $player1 = $request->get('player1');
        $player2 = $request->get('player2');
        $stage = $request->get('stage');

        $player1['playerId'] = Auth::user()->id;

        $match = new Matches;
        $match->winner = $player1['playerId'];
        $match->loser = $player2['playerId'];
        $match->winner_character = $player1['character'];
        $match->loser_character = $player2['character'];
        $match->winner_stocks = $player1['stocks'];
        $match->loser_stocks = $player2['stocks'];
        $match->stage = $stage;

#        Log::info( print_r( $match, true ));
        $match->save();

    }
}
