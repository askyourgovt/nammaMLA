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

	public function creditsPage()
	{
		$this->layout->content = View::make('licensePage');
	}

	public function termsPage()
	{
		$this->layout->content = View::make('licensePage');
	}
	public function contactPage()
	{
		$this->layout->content = View::make('licensePage');
	}
	public function linksPage()
	{
		$this->layout->content = View::make('licensePage');
	}

}