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

Route::get('/language/{lang_key}', 'HomeController@homeLanguageChange');


Route::get('/about', 'StaticPagesController@aboutPage');
Route::get('/license', 'StaticPagesController@licensePage');
Route::get('/credits', 'StaticPagesController@creditsPage');
Route::get('/terms', 'StaticPagesController@termsPage');
Route::get('/links', 'StaticPagesController@linksPage');
Route::get('/contact', 'StaticPagesController@contactPage');


Route::get('/rep/{rep_key}', 'RepController@repHomepage');
Route::get('/rep/{rep_key}/attendance', 'RepController@repAttendance');
Route::get('/rep/{rep_key}/questions', 'RepController@repQuestions');


Route::get('/cabinet/agenda/fourteenth_kar_leg_assembly', 'CabinetController@allMeetingsList');


Route::get('/assembly/{assembly_key}', 'AssemblyController@assemblyMembersList');


Route::get('/api/rep/{rep_key}/attendance/csv', 'ApiCsvController@apiRepAllAttendanceCSV');
Route::get('/api/generic/search_keys/json', 'ApiCsvController@apiSearchKeysJSON');

Route::get('/document/view/{document_key}', 'DocumentController@viewDocument');


