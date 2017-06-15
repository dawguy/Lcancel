<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;

use App\User;

use Validator;

use Log;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $user;
    protected $username = 'name'; //VERY VERY Important. Used to tell auth what to attribute to use as the username.
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

   /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'name' => 'required|max:255|unique:users',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|confirmed|min:6',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
