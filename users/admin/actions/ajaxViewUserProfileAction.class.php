<?php

require_once dirname(__FILE__)."/../locales/Forms/UserViewProfileForm.class.php";


class users_ajaxViewUserProfileAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();      
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_profile_view'))))
           $this->forwardTo401Action();         
        $this->user_settings=  UserSettings::load();
        $this->item = new User($request->getPostParameter('User'),'admin'); // new object          
        if (!$this->item->isAuthorized('view'))
            $this->forwardTo401Action();        
        $this->form = new UserViewProfileForm($this->item,$this->getUser(),$request->getPostParameter('User'));  
        $this->getEventDispather()->notify(new mfEvent($this->form, 'user.view.config',$this->item)); 
       // echo "<pre>"; var_dump($this->item->getTeams()->getKeys());
    }

}
