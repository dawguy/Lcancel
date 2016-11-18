<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatchController;
use App\Models\Matches;
use App\Models\Characters;
use App\Models\PlayerFriends;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Log;

class ProfileController extends Controller
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
     * Show the profile tab.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($playerId){
			$currentUser = Auth::user()->id;

			if($currentUser !== $playerId)
			{
				$areFriends = PlayerFriends::areFriends($currentUser, $playerId);

				if(count($areFriends) > 0){
					$data['areFriends'] = true;
				} else {
					$data['areFriends'] = false;
				}
			}

			$matches = Matches::userMatches($playerId);
			$data['won'] = count($matches['won']);
      $data['lost'] = count($matches['lost']);

			$player = User::find($playerId);
			$data['player'] = $player;

      $data['mainCharacter'] = UserController::mainCharacter($playerId);

      return view('profile', $data);
    }

	/**
	* Show the profile tab for a player with no data
	*
	*/
	public function userIndex(){
		$playerId = Auth::user()->id;
		return $this->index($playerId);
	}
}
