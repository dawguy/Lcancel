<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Auth;
use Log;
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
        $this->middleware('auth');
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
    * Gets the main character for a player
    *
    * @return character.id
    */
    public static function mainCharacter($playerId)
    {
        $characters = DB::table('matches')
        ->select(DB::raw('COUNT(characters.id) as total'), 'characters.id', 'characters.name')
        ->join('characters', 'characters.id', '=', 'matches.winner_character')
        ->groupBy('characters.id')
        ->where('matches.winner', '=', $playerId)->get();

        $maxUsed = -1;
        $mostUsedCharacter = 27;
        $mostUsedCharacterName = 'question';

        Log::infO($characters);

        foreach($characters as $character){
            $count = $character->total;
            if($count > $maxUsed){
                $mostUsedCharacter = $character->id;
                $mostUsedCharacterName = $character->name;
                $maxUsed = $count;
            }
        }

        return array('id' => $mostUsedCharacter, 'name' => $mostUsedCharacterName);
    }
}
