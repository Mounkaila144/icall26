<?php

class users_ajaxDeleteUserPermissionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));      
          $userPermission=new mfValidatorInteger();
          $userPermission_id=$userPermission->isValid($request->getPostParameter('userPermission'));
          $userPermission= new userPermission($userPermission_id,$site);
          $userPermission->delete();
          $response = array("action"=>"deleteUserPermission","id" =>$userPermission_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

