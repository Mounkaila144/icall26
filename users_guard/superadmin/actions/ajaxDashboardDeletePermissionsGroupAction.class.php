<?php

class users_guard_ajaxDashboardDeletePermissionsGroupAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $group=new Group($request->getPostParameter('group'));
         $groupPermissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => groupPermissionUtils::getPermissionsGroupbyGroupList($group))), count($request->getPostParameter('selection')));
         $groupPermissionsValidator->isValid($request->getPostParameter('selection'));        
         $groupPermissions= new GroupPermissionCollection($request->getPostParameter('selection'));
         $groupPermissions->delete();          
         $response = array("action"=>"deletePermissions","parameters" =>$request->getPostParameter('selection'),"info"=>__("Permissions have been deleted."));
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

