<?php

class users_ajaxChangeUserGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {      
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_change_group'))))
            $this->forwardTo401Action();
          $group=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $usergroup_id=$group->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $userGroup= new UserGroup($usergroup_id);         
          if ($userGroup->isLoaded()) 
          {    
              $userGroup->set('is_active',$value);            
              $userGroup->save();          
              $this->getEventDispather()->notify(new mfEvent($userGroup, 'user.change.group','validate')); 
              $response = array("action"=>"ChangeUserGroup","id"=>$usergroup_id,"state" =>$value);
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

