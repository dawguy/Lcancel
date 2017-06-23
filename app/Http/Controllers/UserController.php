<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Matches;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Searches for users.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete()
    {
        $term = Input::get('term');
        $users = User::select('name', 'id')->where('name', 'LIKE', '%' . $term . '%')->get();
        $results = array();

        foreach($users as $user)
        {
            $results[] = ['id' => $user['id'], 'value' => $user['name']];
        }
        return $results;
    }

     /**
      * Gets the stats and character of a player
      * @return player info
      */
      public static function favorite_character($playerId)
      {
          $character_info = User::favorite_character($playerId);
          return $character_info;
      }

}
