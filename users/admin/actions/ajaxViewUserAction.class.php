<?php

require_once dirname(__FILE__)."/../locales/Forms/UserForm.class.php";

class users_ajaxViewUserAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();              
        $this->user=$this->getUser();
        $this->filter = new mfArray($request->getPostParameter('filter'));
        $this->item=new User($request->getPostParameter('User'),'admin');  
        if (!$this->item->isAuthorized('view'))
            $this->forwardTo401Action();  
        $this->form = new UserForm($this->getUser());      
        $this->user_settings=  UserSettings::load();
        $this->getEventDispather()->notify(new mfEvent($this->form, 'user.view.config',$this->item)); 
                        
    }

}

 