<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerFriends extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_friends';

	/**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function playerMatches() 
	{
	  return $this->hasMany('App\Models\User');
	}

}
