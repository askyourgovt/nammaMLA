<?php

class ApiCsvController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.apilayout';
    
	
	public function apiRepAllAttendanceCSV($rep_key)
	{

		$results = DB::table('attendance')
            ->where('rep_key', '=', $rep_key)
            ->select('session_date','attendance')->get();
	


        $this->layout->content = View::make('apiCSV',  array('results' => $results) );

	}

}