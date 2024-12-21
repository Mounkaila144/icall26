<?php

require_once dirname(__FILE__)."/../locales/Forms/UserTeamForm.class.php";

class users_ajaxViewTeamAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                    
        $this->form= new UserTeamForm(array(),$this->site);
        $this->item=new UserTeam($request->getParameter('UserTeam'),$this->site);   
    }

}
