<?php

class CabinetController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function allMeetingsList()
	{
		$this->layout->content = View::make('cabinetAllMeetingsList');
	}



}