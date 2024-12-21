<?php

class users_ajaxDashboardDeleteGroupsAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $user=new user($request->getPostParameter('user'));
         if ($user->isLoaded())
         {    
             $userGroupsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => userGroupUtils::getGroupsUserbyUserList($user))), count($request->getPostParameter('selection')));
             $userGroupsValidator->isValid($request->getPostParameter('selection'));        
             $userGroups= new userGroupCollection($request->getPostParameter('selection'));
             $userGroups->delete();          
             $response = array("action"=>"deleteUserGroups","parameters" =>$request->getPostParameter('selection'));
         }
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

