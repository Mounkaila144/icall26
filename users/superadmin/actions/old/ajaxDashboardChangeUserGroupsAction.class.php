<?php

class users_ajaxDashboardChangeUserGroupsAction extends mfAction {
    
       
    function execute(mfWebRequest $request) { 
       $messages = mfMessages::getInstance();
       try 
      {
          $form=new userGroupsChangeForm($request->getPostParameter('usergroups')); 
          $form->bind($request->getPostParameter('usergroups'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user'));
              if (!$user->isLoaded())
                  throw new mfException(__("user doesn't exist.")); 
              $userGroups= new UserGroupCollection($form->getValue('usergroups')); 
              $userGroups->save();  
              $response = array("action"=>"ChangeUserGroups",
                                "state" =>$form->getValue('value'),
                                "selection" =>$form->getValue("selection")
                               ); 
          }    
          else
          {
              $messages->addErrors($form->getErrorSchema()->getErrors());
          }      
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

