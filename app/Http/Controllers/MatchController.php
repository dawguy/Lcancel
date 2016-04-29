<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;

class MatchController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $searches = array();
        $friends = array();
        $recents = array();

        $user = Auth::user()->name;

        $searchable_users = User::searchable()->get();
        foreach($searchable_users as $user){
            $searches[] = ['name' => $user->name, 'id' => $user->id];
        }

        $friendly_users = User::friendsWith()->get();
        foreach($friendly_users as $user){
            $friends[] = ['name' => $user->name, 'id' => $user->id];
        }

        $recently_played_with_users = User::recentlyPlayedWith()->get();
        foreach($recently_played_with_users as $user){
            $recents[] = ['name' => $user->name, 'id' => $user->id];
        }

        $main_character = 'Peach';

        $data['friends']= $friends;
        $data['recents']= $recents;
        $data['searches']= $searches;
        $data['user'] = $user->name;
        $data['main_character'] = $main_character;

        return view('new_match', $data);
    }

}
