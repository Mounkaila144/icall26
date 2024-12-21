<?php

class users_guard_ajaxDeleteGroupAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
              
          $group=new mfValidatorInteger();
          $group_id=$group->isValid($request->getPostParameter('Group'));
          $group= new Group($group_id,'admin');
          $group->delete();          
          $response = array("action"=>"deleteGroup","id" =>$group_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

