<?php

class users_ajaxDeleteGroupAction extends mfAction {
    
     
     
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {         
          $userGroup=new mfValidatorInteger();
          $userGroup_id=$userGroup->isValid($request->getPostParameter('UserGroup'));
          $userGroup= new UserGroup($userGroup_id);
          $userGroup->delete();
          $this->getEventDispather()->notify(new mfEvent($userGroup, 'user.group.delete')); 
          $response = array("action"=>"deleteUserGroup","id" =>$userGroup_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

