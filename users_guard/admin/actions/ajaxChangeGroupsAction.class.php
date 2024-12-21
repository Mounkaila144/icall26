<?php

class users_guard_ajaxChangeGroupsAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {     
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_change_groups'))))
            $this->forwardTo401Action();
          $param=$request->getPostParameter('groups');
          $groupsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($param['selection']));
          $groups= new GroupCollection($param['selection'],'admin');
          $groups->change($param['value'])
                ->save();
          //$this->getEventDispather()->notify(new mfEvent($groups,'user.guard.group.change'));
          $response = array("action"=>"ChangeGroups","parmeters"=>$groups->getIds(),'state'=>$param['value']);
         
    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

