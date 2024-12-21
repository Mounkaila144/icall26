<?php

class users_ajaxDashboardChangeUserGroupAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          $group=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $usergroup_id=$group->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $userGroup= new UserGroup($usergroup_id);         
          $userGroup->set('is_active',$value);
          if ($userGroup->isLoaded()) 
          {    
              $userGroup->save();
              $response = array("action"=>"ChangeUserGroup","id"=>$usergroup_id,"state" =>$value);
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

