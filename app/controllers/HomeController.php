<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function homeWelcome()
	{
		$this->layout->content = View::make('homeWelcome');
	}

	public function homeLanguageChange($lang_key)
	{

		if($lang_key =="kannada"){
			App::setLocale('kn');
			Session::put('my.locale', 'kn');
		}else{
			App::setLocale('en');
			Session::put('my.locale', 'en');
		}
		return Redirect::to('/');
	}

}