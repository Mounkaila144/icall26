<?php

class users_guard_ajaxDeletePermissionGroupAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();  
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE); 
      try 
      {
          $groupPermission=new mfValidatorInteger();
          $groupPermission_id=$groupPermission->isValid($request->getPostParameter('groupPermission'));
          $groupPermission= new GroupPermission($groupPermission_id,$site);
          $groupPermission->delete();
          $response = array("action"=>"deleteGroupPermission","id" =>$groupPermission_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

