<?php

class users_ajaxCheckLogoutAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $user_logout= new UserLogoutRequest($this->getUser()->getGuardUser());
          if ($user_logout->isLogoutRequested())
          {                          
            $response = array("action"=>"Logout");
          }
          else
          {
             $response="";
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

