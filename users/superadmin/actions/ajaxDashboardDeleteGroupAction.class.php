<?php

class users_ajaxDashboardDeleteGroupAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $userGroup=new mfValidatorInteger();
          $userGroup_id=$userGroup->isValid($request->getPostParameter('userGroup'));
          $userGroup= new userGroup($userGroup_id);
          $userGroup->delete();
          $response = array("action"=>"deleteUserGroup","id" =>$userGroup_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

