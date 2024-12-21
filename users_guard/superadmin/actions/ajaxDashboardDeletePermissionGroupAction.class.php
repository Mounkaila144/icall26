<?php

class users_guard_ajaxDashboardDeletePermissionGroupAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $groupPermission=new mfValidatorInteger();
          $groupPermission_id=$groupPermission->isValid($request->getPostParameter('groupPermission'));
          $groupPermission= new GroupPermission($groupPermission_id);
          $groupPermission->delete();
          $response = array("action"=>"deleteGroupPermission","id" =>$groupPermission_id,"info"=>__("Permission has been deleted.")); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

