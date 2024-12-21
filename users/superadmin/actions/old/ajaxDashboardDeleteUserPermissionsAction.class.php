<?php

class users_ajaxDashboardDeleteUserPermissionsAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $user=new User($request->getPostParameter('user'));
         $userPermissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => userPermissionUtils::getPermissionsUserbyUserList($user))), count($request->getPostParameter('selection')));
         $userPermissionsValidator->isValid($request->getPostParameter('selection'));        
         $userPermissions= new userPermissionCollection($request->getPostParameter('selection'));
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

