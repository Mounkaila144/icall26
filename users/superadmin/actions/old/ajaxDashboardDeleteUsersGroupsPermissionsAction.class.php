<?php

class users_ajaxDashboardDeleteUsersGroupsPermissionsAction extends mfAction {
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
         $form=new usersGroupsPermissionsForm($request->getPostParameter('selection'));
         $form->bind($request->getPostParameter('selection'));
         if ($form->isValid()) 
         {
            if ($form->getValue('userPermission'))
            {    
                $userPermissions= new userPermissionCollection($form->getValue('userPermission'));
             //   $userPermissions->delete();   
            }
            if ($form->getValue('groupPermission'))
            {    
                $groupPermissions= new groupPermissionCollection($form->getValue('groupPermission'));
              //  $groupPermissions->delete();   
            }
            $response = array("action"=>"deleteUsersGroupsPermissions","parameters" =>$form->getValues());    
         }
         else
         {
            $errors=$form->getErrorSchema();
            $messages->addErrors(array_merge($errors->getGlobalErrors(),$errors->getErrors()));
         }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors('error')):$response;
    }

}

