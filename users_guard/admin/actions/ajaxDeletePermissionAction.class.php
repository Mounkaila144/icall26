<?php

class users_guard_ajaxDeletePermissionAction extends mfAction {
    
     
     
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();                
      try 
      {             
           if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_delete_permission'))))
            $this->forwardTo401Action();
          $permission=new mfValidatorInteger();
          $permission_id=$permission->isValid($request->getPostParameter('permission'));
          $permission= new Permission($permission_id,'admin');
          $permission->delete();                  
          $this->getEventDispather()->notify(new mfEvent($permission,'permission.delete'));
          $response = array("action"=>"deletePermission","id" =>$permission_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

