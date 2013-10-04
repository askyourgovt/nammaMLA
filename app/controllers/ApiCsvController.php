<?php

class ApiCsvController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function apiRepAllAttendanceCSV()
	{
		$this->layout->content = View::make('apiCSV');
	}

}