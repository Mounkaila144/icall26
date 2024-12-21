<?php

class users_guard_ajaxDashboardDeleteGroupAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $group=new mfValidatorInteger();
          $group_id=$group->isValid($request->getPostParameter('group'));
          $group= new Group($group_id);
           $group->delete();          
          $response = array("action"=>"deleteGroup","id" =>$group_id,"info"=>__("Group has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

