<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Default Home Route
Route::get('/', 'HomeController@Index');

// Match Routes
Route::get('/matches', 'MatchController@index');
Route::get('/matches/report_match', 'MatchController@report');
Route::get('/matches/{match}', 'MatchController@match');

// User Routes
Route::get('/users/search', 'UserController@autocomplete');
Route::get('/users/favorite_character/{playerId}', 'UserController@favorite_character');

// Character Matchup Routes
Route::get('/matchups/character/{character}', 'MatchupController@character');
Route::get('/matchups/characters/{first_character}/{second_character}', 'MatchupController@character_matchup');
Route::get('/matchups/players/{first_player}/{second_player}', 'MatchupController@player_matchup');
Route::get('/matchups/players/{first_player}/{second_player}/characters/{first_character}/{second_character}', 'MatchupController@player_matchup_with_selected_character');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	// Authentication Routes
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@login');
	Route::get('logout', 'Auth\AuthController@getLogout');

	// Registration Routes
	Route::get('register', 'Auth\AuthController@showRegistrationForm');
	Route::post('register', 'Auth\AuthController@register');

	// Password Reset Routes
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');

	// Match Routes
	Route::put('match', 'MatchController@putMatch');

	// History Routes
    Route::get('history', 'HistoryController@userIndex');
	Route::get('history/{playerId}', 'HistoryController@index');

	// User Routes
	Route::get('users/mainCharacter/{playerId}', 'UserController@mainCharacter');

	// Friends Routes
    Route::get('friends', 'FriendController@index');
	Route::put('friends/add/{playerId}', 'FriendController@addFriend');
    Route::delete('friends/remove/{playerId}', 'FriendController@removeFriend');

    // Profile Routes
    Route::get('profile', 'ProfileController@userIndex');
    Route::get('profile/{playerId}', 'ProfileController@index');

    // Visualization Routes
    Route::get('matchup', 'MatchupController@index');
    Route::get('matchup/playerTreemap/playerOne/{playerOne}/playerTwo/{playerTwo}', 'MatchupController@playerRecordTreemap');
    Route::get('matchup/playerJson/playerOne/{playerOne}/playerTwo/{playerTwo}', 'MatchupController@playerRecordVsPlayer');

    //Data Routes
    Route::get('statistics/playerOne/{playerOne}/opponentCharacter/{opponentCharacter}', 'StatisticsController@playerVsCharacter');
    Route::get('statistics/eloVsTime/playerOne/{playerOne}', 'StatisticsController@playerEloVsTime');
    Route::get('statistics/characterOne/{characterOne}/characterTwo/{characterTwo}', 'StatisticsController@characterVsCharacter');
    Route::get('statistics/playerOne/{playerOne}/playerTwo/{playerTwo}', 'StatisticsController@playerVsPlayer');
    Route::get('statistics/playerOne/{playerOne}/playerTwo/{playerTwo}/playerOneCharacter/{playerOneCharacter}', 'StatisticsController@playerAsCharacterVsPlayer');

});
