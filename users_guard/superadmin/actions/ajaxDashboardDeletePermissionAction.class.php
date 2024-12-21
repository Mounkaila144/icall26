<?php

class users_guard_ajaxDashboardDeletePermissionAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $permission=new mfValidatorInteger();
          $permission_id=$permission->isValid($request->getPostParameter('permission'));
          $permission= new Permission($permission_id);
          $permission->delete();          
          $response = array("action"=>"deletePermission","id" =>$permission_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

