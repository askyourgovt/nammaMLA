<?php


class RepController extends BaseController {

	
	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.reppage';
    
	
	public function repHomepage($rep_key)
	{
		$rep = Reps::where('rep_key', '=', $rep_key)->firstOrFail();
		//You will have to get the latest and should have no end date
		$rep_role = DB::table('rep_role')
            ->join('assembly', 'rep_role.assembly_key', '=', 'assembly.assembly_key')
		    ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')
		    ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
		    ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('rep_role.rep_key', '=', $rep_key)
            ->orderBy('rep_role.end', 'desc')
            ->orderBy('roles.weightage', 'desc')
            ->select('roles.role_name','parties.party_name','constituency.constituency_name','constituency.constituency_number','parties.party_name','rep_role.ec_affidavits','rep_role.assembly_key', 'rep_role.end', 'rep_role.start','assembly.assembly_name')->first();
            //var_dump($rep_role);



        //last assembly
        $assembly_key = $rep_role->assembly_key;
        //last session of the assembly
		$sessions = DB::table('sessions')
            ->where('assembly_key', '=', $assembly_key)
            ->orderBy('end', 'desc')
            ->select('sessions.key','sessions.total_working_days','sessions.average_attendance')->first();



        $session_key = $sessions->key;
		$attendance_session = DB::table('attendance')
            ->where('rep_key', '=', $rep_key)
            ->where('session_key', '=', $session_key)
            ->groupBy('attendance')
            ->orderBy('attendance','desc')            
            ->select(DB::raw('count(attendance) as attendance_count, attendance'))->get();

		$attendance_overall = DB::table('attendance')
            ->where('rep_key', '=', $rep_key)
            ->groupBy('attendance')            
            ->orderBy('attendance','desc')            
            ->select(DB::raw('count(attendance) as attendance_count, attendance'))->get();

            //var_dump($attendance_session);

		$this->layout->content = View::make('repHomepage',  array('rep' => $rep,'rep_role' => $rep_role,'attendance_session' => $attendance_session, 'attendance_overall' => $attendance_overall) );
	}


	public function repAttendance($rep_key)
	{
		$rep = Reps::where('rep_key', '=', $rep_key)->firstOrFail();
		//You will have to get the latest and should have no end date
		$rep_role = DB::table('rep_role')
		    ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')
		    ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
		    ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('rep_key', '=', $rep_key)
            ->orderBy('end', 'asc')
            ->select('roles.role_name','parties.party_name','constituency.constituency_name','constituency.constituency_number','parties.party_name','rep_role.ec_affidavits')->first();
        //get the latest session and his attendance

        //var_dump($rep_role);
		$this->layout->content = View::make('repAttendance',  array('rep' => $rep,'rep_role' => $rep_role) );
	}


	public function repQuestions($rep_key)
	{
		$rep = Reps::where('rep_key', '=', $rep_key)->firstOrFail();
		//You will have to get the latest and should have no end date
		$rep_role = DB::table('rep_role')
		    ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')
		    ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
		    ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('rep_key', '=', $rep_key)
            ->select('roles.role_name','parties.party_name','constituency.constituency_name','constituency.constituency_number','parties.party_name','rep_role.ec_affidavits')->first();

        //Get questions
		$questions = DB::table('questions')
			->join('departments','questions.dept_key','=','departments.dept_key')
			->join('sessions','questions.session_key' ,'=', 'sessions.key')
			->join('assembly','assembly.assembly_key' ,'=', 'sessions.assembly_key')

	        ->where('rep_key', '=', $rep_key)
	        ->select('assembly.assembly_name','questions.question','questions.asked_date','questions.question_type','departments.dept_name','sessions.session_name')->get();

		$this->layout->content = View::make('repQuestions',  array('rep' => $rep,'rep_role' => $rep_role, 'questions' => $questions) );
	}

}