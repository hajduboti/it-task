<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List cases
Route::get('flightcases', 'FlightcaseController@index');

//Retrieve a single case
Route::get('flightcase/{id}', 'FlightcaseController@show');

//Create a new case
Route::post('flightcase', 'FlightcaseController@store');

//Update a case
Route::put('flightcase', 'FlightcaseController@store');

//Delete a case
Route::delete('flightcase/{id}', 'FlightcaseController@destroy');

//List passengers
Route::get('passengers', 'PassengerController@index');

//Retrieve a single passenger
Route::get('passenger/{id}', 'PassengerController@show');

//Create a new passenger
Route::post('passenger', 'PassengerController@store');

//Update a passenger
Route::put('passenger', 'PassengerController@store');

//Delete a passenger
Route::delete('passenger/{id}', 'PassengerController@destroy');