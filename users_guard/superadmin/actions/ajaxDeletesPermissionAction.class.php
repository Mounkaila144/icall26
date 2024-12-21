<?php

class users_guard_ajaxDeletesPermissionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
      try 
      {
          $permissionsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $permissionsValidator->isValid($request->getPostParameter('selection'));        
          $permissions= new PermissionCollection($request->getPostParameter('selection'),'admin',$site);
          $permissions->delete();          
          $response = array("action"=>"deletePermissions","parameters" =>$request->getPostParameter('selection'));
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

