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

    public function apiSearchKeysJSON()
    {

        $assembly_key ='fourteenth_kar_leg_assembly';
        $assembly = Assembly::where('assembly_key', '=', $assembly_key)->firstOrFail();
        //You will have to get the latest and should have no end date
        $rep_role = DB::table('rep_role')
            ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')        
            ->join('representatives', 'rep_role.rep_key', '=', 'representatives.rep_key')
            ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
            ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('assembly_key', '=', $assembly_key)
            ->select('representatives.name as name')->get();
            #var_dump($assembly);
            $arr = array();
            foreach ($rep_role as $r){
                $arr[] = $r->name;
            }
            return Response::json($arr);

    }

}