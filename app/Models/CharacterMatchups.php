<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterMatchups extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'character_matchups';

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
