<?php

class users_guard_ajaxDeletePermissionAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
      try 
      {
          if (!$site) 
              throw new mfException(__("thanks to select a site"));            
          $permission=new mfValidatorInteger();
          $permission_id=$permission->isValid($request->getPostParameter('permission'));
          $permission= new Permission($permission_id,array('admin','frontend'),$site);
          $permission->delete();          
          $response = array("action"=>"deletePermission","id" =>$permission_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

