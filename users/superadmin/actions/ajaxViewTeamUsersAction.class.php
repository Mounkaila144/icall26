<?php

require_once dirname(__FILE__)."/../locales/Forms/TeamUsersForm.class.php";

class users_ajaxViewTeamUsersAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                           
        $this->item=new UserTeam($request->getParameter('UserTeam'),$this->site);   
        $this->form= new TeamUsersForm(array('users'=>$this->item->getUsersById()),$this->site);     
    }

}
