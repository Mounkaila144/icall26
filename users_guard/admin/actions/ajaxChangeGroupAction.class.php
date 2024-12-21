<?php

class users_guard_ajaxChangeGroupAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {     
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_change_group'))))
            $this->forwardTo401Action();
          $group=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $group_id=$group->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $group= new Group($group_id,array('frontend','admin'));         
          if ($group->isLoaded()) 
          {    
              $group->set('is_active',$value);
              $group->save();
              $this->getEventDispather()->notify(new mfEvent($group,'user.guard.group.change'));
              $response = array("action"=>"ChangeGroup","id"=>$group_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

