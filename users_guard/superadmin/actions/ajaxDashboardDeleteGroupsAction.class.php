<?php

class users_guard_ajaxDashboardDeleteGroupsAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $groupsValidator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('selection')));
          $groupsValidator->isValid($request->getPostParameter('selection'));        
          $groups= new GroupCollection($request->getPostParameter('selection'));
          $groups->delete();          
          $response = array("action"=>"deleteGroups",
                            "parameters" =>$request->getPostParameter('selection'),
                            "info"=>__("Groups have been deleted.")
                            );
      } 
      catch (mfValidatorErrorSchema $e)
      {
          $messages->addErrors(array_merge($e->getGlobalErrors(),$e->getErrors()));
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      $response=$messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
      return $response;
    }

}

