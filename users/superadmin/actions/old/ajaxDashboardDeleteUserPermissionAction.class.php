<?php
//class users_ajaxDashboardDeletePermissionAction extends mfAction {
class users_ajaxDashboardDeleteUserPermissionAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $userPermission=new mfValidatorInteger();
          $userPermission_id=$userPermission->isValid($request->getPostParameter('userPermission'));
          $userPermission= new userPermission($userPermission_id);
        //  $userPermission->delete();
          $response = array("action"=>"deleteUserPermission","id" =>$userPermission_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

