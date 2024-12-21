<?php

class users_ajaxRemoveDuplicateTeamUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/users");
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));  
          UserTeamUtils::RemoveDuplicate($site);
          $response = array("info"=>__("Duplicates have been removed."));            
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

