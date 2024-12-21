<?php

class users_ajaxDeleteGroupAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site) 
              throw new mfException(__("thanks to select a site"));  
          $userGroup=new mfValidatorInteger();
          $userGroup_id=$userGroup->isValid($request->getPostParameter('userGroup'));
          $userGroup= new UserGroup($userGroup_id,$site);
          $userGroup->delete();
          $response = array("action"=>"deleteUserGroup","id" =>$userGroup_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

