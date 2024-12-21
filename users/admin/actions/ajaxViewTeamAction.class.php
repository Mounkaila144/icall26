<?php

require_once dirname(__FILE__)."/../locales/Forms/UserTeamForm.class.php";

class users_ajaxViewTeamAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->form= new UserTeamForm();
        $this->item=new UserTeam($request->getParameter('UserTeam'));   
    }

}
