<?php

class users_guard_ajaxDeletesPermissionAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
        
      try 
      {
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_delete_permission_multiple'))))
            $this->forwardTo401Action();
          $permissionsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $permissionsValidator->isValid($request->getPostParameter('selection'));        
          $permissions= new PermissionCollection($request->getPostParameter('selection'),'admin');
          $permissions->delete();    
           $this->getEventDispather()->notify(new mfEvent($permissions,'permissions.delete'));
          $response = array("action"=>"deletePermissions","parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

