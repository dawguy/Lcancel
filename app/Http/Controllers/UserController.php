<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * Searches for users.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete()
    {
        $term = Input::get('term');
        $users = User::select('name', 'id')->where('name', 'LIKE', '%' . $term . '%')->get();
        $results = array();

        foreach($users as $user)
        {
            $results[] = ['id' => $user['id'], 'value' => $user['name']];
        }
        return $results;
    }
}
