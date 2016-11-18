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
			$data = array();
			$player = User::find($playerId);

			$won = Matches::userWonMatches($playerId);
			$lost = Matches::userLostMatches($playerId);

			$data['won'] = $won;
			$data['lost'] = $lost;

      return $data;
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
