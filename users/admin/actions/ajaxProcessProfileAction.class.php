<?php

require_once __DIR__."/../locales/Forms/UserProfileViewForm.class.php";
 
class  users_ajaxProcessProfileAction extends mfAction {
    
      function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();    
       if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_view'))))
            $this->forwardTo401Action();
       try
       {       
            $item=new UserProfile($request->getPostParameter('UserProfile')); 
            if ($item->isNotLoaded())
                throw new mfException(__('Profile is invalid.'));        
            $engine =  new UserProfileGroupOptimizationEngine($item,$this->getUser());
            $engine->process();
            $messages->addInfo(__('Profiles have been optimized.'));          
            $this->forward($this->getModuleName(),'ajaxListPartialProfile');
       }
      catch (mfException $e) {
          $messages->addError($e);
      }      
      $this->forward($this->getModuleName(),'ajaxViewProfileI18n');
}
}

