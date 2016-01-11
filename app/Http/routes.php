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
Route::post('/pia/register', 'StudentController@store');
Route::get('pia', 'StudentController@index');
Route::get('/analyze/{id}/given/{given}/method/{method}', 'DataController@analyze');
Route::get('/analyze/user/{id}', 'DataController@analyzeUserInput');
Route::post('pia/login', 'StudentController@login');
Route::get('pia/logout', 'StudentController@logout');
Route::get('pia/method/{method}', 'StudentController@method');
Route::get('pia/{id}', 'StudentController@action');


