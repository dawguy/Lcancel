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
        $playerOne = DB::table('player_friends')
                            ->select('player_friends.player_two')
                            ->where('player_friends.player_one', '=', Auth::user()->id)
                            ->get();

        $playerTwo = DB::table('player_friends')
                            ->select('player_friends.player_one')
                            ->where('player_friends.player_two', '=', Auth::user()->id)
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
                    ->where('id', '<>', Auth::user()->id)
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
                    ->where('id', '<>', Auth::user()->id)
                    ->get();

        return $friends;
    }
}
