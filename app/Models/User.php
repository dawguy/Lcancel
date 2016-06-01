<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;

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