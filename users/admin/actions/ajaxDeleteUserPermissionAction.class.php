<?php

class users_ajaxDeleteUserPermissionAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {         
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_delete_user_permission'))))
            $this->forwardTo401Action();
          $userPermission=new mfValidatorInteger();
          $userPermission_id=$userPermission->isValid($request->getPostParameter('userPermission'));
          $userPermission= new userPermission($userPermission_id);
          $userPermission->delete();
            $this->getEventDispather()->notify(new mfEvent($userPermission,'user.permission.delete',array('user'=>$userPermission->getUser())));
          $response = array("action"=>"deleteUserPermission","id" =>$userPermission_id); 
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

