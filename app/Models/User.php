<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Auth;
use Log;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearchable($query, $value){
        $players = DB::table('users')
                ->where('name', 'LIKE', '%value%')
                ->get();
        return $players;
    }

    public function scopeFriendsWith($query){
        $playerOne = DB::table('users')
                            ->join('player_friends', 'users.id', '=', 'player_friends.player_one')
                            ->select('player_friends.player_two')
                            ->get();

        $playerTwo = DB::table('users')
                            ->join('player_friends', 'users.id', '=', 'player_friends.player_two')
                            ->select('player_friends.player_one')
                            ->get();

        $playerIds = array();

        foreach($playerOne as $playerId){
            $playerIds[] = $playerId->player_two;
        }

        foreach($playerTwo as $playerId){
            $playerIds[] = $playerId->player_one;
        }

        $friends = DB::table('users')
                    ->whereIn('id', $playerIds)
                    ->get();

        return $friends;
    }

    public function scopeRecentlyPlayedWith($query){
        $playerWinners = DB::table('matches')
                            ->select('matches.loser')
                            ->where('matches.winner', '=', Auth::user()->id)
                            ->get();

        $playerLosers = DB::table('matches')
                            ->select('matches.winner')
                            ->where('matches.loser', '=', Auth::user()->id)
                            ->get();

        $playerIds = array();

        foreach($playerWinners as $playerId){
            $playerIds[] = $playerId->loser;
        }

        foreach($playerLosers as $playerId){
            $playerIds[] = $playerId->winner;
        }

        $friends = DB::table('users')
                    ->whereIn('id', $playerIds)
                    ->get();

        return $friends;
    }
}
