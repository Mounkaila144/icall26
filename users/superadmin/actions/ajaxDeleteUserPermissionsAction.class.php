<?php

class users_ajaxDeleteUserPermissionsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
         if (!$site) 
              throw new mfException(__("thanks to select a site"));  
         $user=new User($request->getPostParameter('User'),'admin',$site);
         $userPermissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => userPermissionUtils::getPermissionsUserbyUserList($user))), count($request->getPostParameter('selection')));
         $userPermissionsValidator->isValid($request->getPostParameter('selection'));        
         $userPermissions= new userPermissionCollection($request->getPostParameter('selection'),$site);
         $userPermissions->delete();          
         $response = array("action"=>"deleteUserPermissions","parameters" =>$request->getPostParameter('selection'));
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

