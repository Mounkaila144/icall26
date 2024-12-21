<?php

class users_guard_ajaxDashboardChangeGroupAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          $group=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $group_id=$group->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $group= new Group($group_id);         
          if ($group->isLoaded()) 
          {    
              $group->set('is_active',$value);
              $group->save();
              $response = array("action"=>"ChangeGroup","id"=>$group_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

