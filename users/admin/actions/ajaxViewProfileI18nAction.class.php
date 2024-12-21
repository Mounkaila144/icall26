<?php

require_once dirname(__FILE__)."/../locales/Forms/UserProfileViewForm.class.php";
 
class users_ajaxViewProfileI18nAction extends mfAction {
    
    

        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();        
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_view'))))
           $this->forwardTo401Action();
        $this->user=$this->getUser();
        $this->item_i18n=new UserProfileI18n($request->getPostParameter('UserProfileI18n')); 
        $this->form = new UserProfileViewForm();               
        $this->form->setProfile($this->item_i18n->getProfile());
   }

}

