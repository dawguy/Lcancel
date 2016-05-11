<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerMatches extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_matches';

	/**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function users() 
	{
	  return $this->belongsTo('App\Models\User');
	}

}
