<?php

class RepController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function repHomepage()
	{
		$this->layout->content = View::make('repHomepage');
	}


	public function repAttendance()
	{
		$this->layout->content = View::make('repAttendance');
	}

}