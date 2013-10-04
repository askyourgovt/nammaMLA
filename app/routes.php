<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@homeWelcome');

Route::get('/about', 'StaticPagesController@aboutPage');
Route::get('/license', 'StaticPagesController@licensePage');


Route::get('/rep/{rep_key}', 'RepController@repHomepage');
Route::get('/rep/attendance/{rep_key}', 'RepController@repAttendance');



Route::get('/api/rep/{rep_key}/attendance/csv', 'ApiCsvController@apiRepAllAttendanceCSV');

