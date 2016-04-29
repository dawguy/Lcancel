<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','wins','losses','elo',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearchable($query){
        return $query;
    }

    public function scopeFriendsWith($query){
        return $query->where('name', '=', 'dawguy');
    }

    public function scopeRecentlyPlayedWith($query){
        return $query->where('name', '=', 'jjllama');
    }
}
