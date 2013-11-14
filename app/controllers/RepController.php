<?php


class RepController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';
    
	
	public function repHomepage($rep_key)
	{
		$rep = Reps::where('rep_key', '=', $rep_key)->firstOrFail();
		//You will have to get the latest and should have no end date
		$rep_role = DB::table('rep_role')
		    ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')
		    ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
		    ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('rep_key', '=', $rep_key)
            ->select('roles.role_name','parties.party_name','constituency.constituency_name','constituency.constituency_number')->first();
            //var_dump($rep_role);
		$this->layout->content = View::make('repHomepage',  array('rep' => $rep,'rep_role' => $rep_role) );
	}


	public function repAttendance()
	{
		$this->layout->content = View::make('repAttendance');
	}

}