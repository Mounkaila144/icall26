<?php

class users_ajaxDisableUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('User'));
          $user= new User($user_id,'admin');
          if ($user->isLoaded())
          {    
            $user->set('is_active','NO')->disable();           
            $this->getEventDispather()->notify(new mfEvent($user, 'user.change','disable')); 
            $response = array("action"=>"DisableUser","id" =>$user->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

