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

    /**
     * Show the friend dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = array();
        $searches = array();
        $friends = array();
        $recents = array();

        $currentUser = Auth::user();

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

        $main_character = UserController::mainCharacter($currentUser->id);

        $data['friends']= $friends;
        $data['recents']= $recents;
        $data['searches']= $searches;
        $data['user'] = $currentUser->name;
        $data['userId'] = $currentUser->id;
        $data['player1Character'] = $main_character['id'];
        $data['main_character'] = $main_character['name'];

        return view('friends', $data);
    }
}
?>