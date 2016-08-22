<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;

class Matches extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matches';

	/**
    * Gets a list of matches that a user was part of.
    *
    * @return array(matches)
    */
    public function scopeUserMatches($query, $playerId)
    {
    	// Get loser name too
        $wonMatches = Matches::where('winner', '=', $playerId)
        ->join('users', 'users.id', '=', 'matches.loser')
        ->get();
        // Get winner name too
        $lostMatches = Matches::where('loser', '=', $playerId)
        ->join('users', 'users.id', '=', 'matches.winner')
        ->get();

        $matches = array();

        foreach($wonMatches as $match){
            $matches[] = $match;
        }

        foreach($lostMatches as $match){
            $matches[] = $match;
        }

        return $matches;
    }

	/**
    * Gets a list of matches that a user won
    *
    * @return array(won matches)
    */
    public function scopeUserWonMatches($query, $playerId)
    {
    	// Get loser name too
        $wonMatches = Matches::where('winner', '=', $playerId)
        ->get();

        return $wonMatches;
    }

	/**
	* Gets a list of matches that a user lost
	*
	* @return array(lost matches)
	*/
	public function scopeUserLostMatches($query, $playerId)
	{
		// Get loser name too
		$lostMatches = Matches::where('loser', '=', $playerId)
		->get();

		return $lostMatches;
	}

}
