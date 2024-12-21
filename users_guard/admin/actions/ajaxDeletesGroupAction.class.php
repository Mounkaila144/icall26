<?php

class users_guard_ajaxDeletesGroupAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
        
      try 
      {
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_delete_group_multiple'))))
            $this->forwardTo401Action();
          $groupsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $groupsValidator->isValid($request->getPostParameter('selection'));        
          $groups= new GroupCollection($request->getPostParameter('selection'),'admin');
          $groups->delete();    
          $response = array("action"=>"deleteGroups","parameters" =>$request->getPostParameter('selection'));
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

