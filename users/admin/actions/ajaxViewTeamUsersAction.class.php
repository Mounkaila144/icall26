<?php

require_once dirname(__FILE__)."/../locales/Forms/TeamUsersForm.class.php";

class users_ajaxViewTeamUsersAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        $this->item=new UserTeam($request->getParameter('UserTeam'));   
        $this->form= new TeamUsersForm(array('users'=>$this->item->getUsersById()));     
    }

}
