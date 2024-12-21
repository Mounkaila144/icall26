<?php

class users_ajaxDashboardDeleteUserAction extends mfAction {
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('user'));
          $user= new User($user_id);
          $user->delete();          
          $this->getEventDispather()->notify(new mfEvent($user, 'user.change','delete'));        
          $response = array("action"=>"deleteUser","id" =>$user_id,"info"=>__("user [%s] has been deleted.",(string)$user));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;      
    }
}

