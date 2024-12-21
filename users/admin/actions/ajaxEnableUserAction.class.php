<?php

class users_ajaxEnableUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {    
          if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_enable'))))
            $this->forwardTo401Action();
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('User'));
          $user= new User($user_id,'admin');
          if ($user->isLoaded())
          {    
            $user->set('is_active','YES')->enable();                            
            $this->getEventDispather()->notify(new mfEvent($user, 'user.change','enable')); 
            $response = array("action"=>"EnableUser","id" =>$user->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

