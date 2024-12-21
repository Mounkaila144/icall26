<?php

class users_ajaxDeleteUsersAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
          if (!$site) 
              throw new mfException(__("thanks to select a site"));      
          $usersValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $usersValidator->isValid($request->getPostParameter('selection'));
          $users= new UserCollection($request->getPostParameter('selection'),'admin',$site);
          $users->delete();          
          $this->getEventDispather()->notify(new mfEvent($users, 'users.change','delete')); 
          $response = array("action"=>"deleteUsers","parameters" =>$request->getPostParameter('selection'));
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

