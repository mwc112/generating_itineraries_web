<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/register', 'AuthController@showRegistrationForm');
Route::post('/register', 'AuthController@register');

Route::get('/confirm_email', 'ConfirmEmailController@confirmEmail');

Route::get('/login', function() {
		return view('login');
	});

Route::post('/login', 'AuthController@authenticateUser');

Route::get('/logout', 'AuthController@logout');

Route::get('/user', 'ShowUserController@showUser');

Route::post('/user', 'ShowUserController@updateUser');

Route::get('/app_login', 'AppLoginController@login');

Route::get('/disruption', 'TravelDisruptionController@getDisruption');

Route::get('/save_trip', 'SaveTripController@methodChoose');

Route::get('/trips', 'ShowTripsController@showTrips');
Route::post('/trips', 'ShowTripsController@markTrips');

Route::get('/map', function() {
		return view('map');
	});
?>
