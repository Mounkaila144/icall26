<?php

class userGuard_ajaxGroupsDeleteGroupsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
      
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
      if (!$site) 
           return ;
      try 
      {
          $groupsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $groupsValidator->isValid($request->getPostParameter('selection'));        
          $groups= new GroupCollection($request->getPostParameter('selection'),array('frontend','admin'),$site);
          $groups->delete();          
          $response = array("action"=>"deleteGroups","parameters" =>$request->getPostParameter('selection'));
      }       
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;    
    }

}

