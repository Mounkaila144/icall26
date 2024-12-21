<?php

class users_ajaxLogoutUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {                 
          $user= new User($request->getPostParameter('User'),'admin');
          if ($user->isLoaded() && $user->get('id') != $this->getUser()->getGuardUser()->get('id'))
          {               
              //return date last connexion  / off connected
            $logout=new UserLogoutRequest($user);
            $logout->logout();
        
            $response = array("action"=>"LogoutUser",
                              
                              "id" =>$user->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

