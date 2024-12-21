<?php

class users_ajaxDashboardDeletesUserAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $usersValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $usersValidator->isValid($request->getPostParameter('selection'));        
          $users= new UserCollection($request->getPostParameter('selection'));
          $users->delete();        
          $this->getEventDispather()->notify(new mfEvent($users, 'users.change','delete')); 
          $response = array("action"=>"deletesDashboardUser",
                            "info"=>__("Users have been deleted."),
                            "parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

