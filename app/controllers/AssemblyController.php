<?php


class AssemblyController extends BaseController {

    
    /**
    * The layout that should be used for responses.
    */
    protected $layout = 'layouts.fullpage';
    
    
    public function assemblyMembersList($assembly_key)
    {
        $assembly = Assembly::where('assembly_key', '=', $assembly_key)->firstOrFail();
        //You will have to get the latest and should have no end date
        $rep_role = DB::table('rep_role')
            ->join('roles', 'rep_role.role_key', '=', 'roles.role_key')        
            ->join('representatives', 'rep_role.rep_key', '=', 'representatives.rep_key')
            ->join('parties', 'rep_role.party_key', '=', 'parties.party_key')
            ->join('constituency', 'rep_role.constituency_key', '=', 'constituency.constituency_key')
            ->where('assembly_key', '=', $assembly_key)
            ->select('roles.role_name','representatives.rep_key','parties.party_name','constituency.constituency_name','constituency.constituency_number','parties.party_name','rep_role.ec_affidavits','representatives.name')->get();
            #var_dump($assembly);
        $this->layout->content = View::make('assemblyMembersList',  array('assembly' => $assembly,'all_reps' => $rep_role) );
    }




}