<?php

class users_ajaxRefreshConnectedUsersAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {                 
           $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('Users')));
           $selection=$validator->isValid($request->getPostParameter('Users'));                    
            $response = array("action"=>"RefreshConnectedUsers",
                              "connected_users"=>UserUtils::getConnectedUsersByUsers($selection)
                            );
                              
           
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

