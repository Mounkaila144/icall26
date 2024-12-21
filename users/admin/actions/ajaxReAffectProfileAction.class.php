<?php

require_once __DIR__."/../locales/Forms/ProfileReAffectForm.class.php";

class users_ajaxReAffectProfileAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();                     
          $this->profile=new UserProfile($request->getPostParameter('id')) ;
          if ($this->profile->isNotLoaded())
              return;
          $this->form=new ProfileReAffectForm($this->profile);       
    }

}
