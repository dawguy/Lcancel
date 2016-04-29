<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

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

        $user = Auth::user()->name;

        $friends = array();
        $friends[] = 'Friend';
        $friends[] = 'Friend 1';
        $friends[] = 'Friend 2';

        $recents = array();
        $recents[] = 'Recent';
        $recents[] = 'Recent 1';

        $searches = array();
        $searches[] = 'Search';
        $searches[] = 'Search 1';
        $searches[] = 'Search 2';
        $searches[] = 'Search 3';
        $searches[] = 'Search 4';

        $main_character = 'Peach';

        $data['friends']= $friends;
        $data['recents']= $recents;
        $data['searches']= $searches;
        $data['user'] = $user;
        $data['main_character'] = $main_character;

        return view('new_match', $data);
    }

}
