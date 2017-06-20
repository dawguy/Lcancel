<?php namespace App;

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
	 * Get the winner assocaited with the Matches
	 */
	public function winner()
	{
		return $this->belongsTo('App\User', 'winner', 'id');
	}

	/**
	 * Get the losing character assocaited with the match
	 */
	public function winner_character()
	{
		return $this->belongsTo('App\Character', 'winner_character', 'id');
	}

	/**
	 * Get the loser assocaited with the match
	 */
	public function loser()
	{
		return $this->belongsTo('App\User', 'loser', 'id');
	}

	/**
	 * Get the losing character assocaited with the match
	 */
	public function loser_character()
	{
		return $this->belongsTo('App\Character', 'loser_character', 'id');
	}

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
