<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\PlayerFriends;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Log;

class FriendController extends Controller
{
    /**
    * Adds a friend to the current user
    */
    public function addFriend(Request $request){
        $playerId = $request['playerId'];
        $currentUser = Auth::user()->id;

        $areFriends = count(PlayerFriends::areFriends($currentUser, $playerId)) > 0;

        if($areFriends){
            return;
        }

        $new_player_friend = new PlayerFriends();
        $new_player_friend->player_one = $currentUser;
        $new_player_friend->player_two = $playerId;
        $new_player_friend->save();
    }

    /**
    * Removes a friend from the current user
    */
    public function removeFriend(Request $request){
        $playerId = $request['playerId'];
        $currentUser = Auth::user()->id;

        $playerFriends = PlayerFriends::areFriends($currentUser, $playerId);

        foreach($playerFriends as $friend){
            PlayerFriends::where('id', '=', $friend['id'])->delete();
        }
    }
}
?>
