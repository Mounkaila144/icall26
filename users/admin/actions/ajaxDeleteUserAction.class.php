<?php

class users_ajaxDeleteUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('User'));
          $user= new User($user_id,'admin');
          if ($user->isLoaded())
          {    
            $user->delete();                     
            $this->getEventDispather()->notify(new mfEvent($user, 'user.change','delete')); 
            $response = array("action"=>"deleteUser","id" =>$user->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

