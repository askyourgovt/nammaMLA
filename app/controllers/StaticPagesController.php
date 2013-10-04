<?php

class StaticPagesController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function aboutPage()
	{
		$this->layout->content = View::make('aboutPage');
	}


	public function licensePage()
	{
		$this->layout->content = View::make('licensePage');
	}

}