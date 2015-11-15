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
Route::post('/register/{id}', 'StudentController@update');
Route::get('pia/register', 'StudentController@register');
Route::resource('pia', 'StudentController');

Route::get('/generate/{id}', 'GenerateController@generate');
Route::get('/showimages', 'StudentController@showpix');
Route::get('analyze/{id}', 'DataController@analyze');
Route::get('/test', 'DataController@test');
