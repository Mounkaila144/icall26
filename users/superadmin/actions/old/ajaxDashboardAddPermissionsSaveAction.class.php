<?php


class users_ajaxDashboardAddPermissionsSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();     
        try 
      {
          $form=new addPermissionsUserForm($request->getPostParameter('permissions'));
          $form->bind($request->getPostParameter('permissions'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user_id'));
              if ($user->isLoaded())
              {   
                $userPermissions = new UserPermissionCollection($form->getValue('permissions'));  
                $userPermissions->save();
                $messages->addInfo(__("permissions added on user [%s].",$user));
                $request->addRequestParameter('user', $user);
                $this->forward('users','ajaxDashboardPermissionsList');   
              }  
          }    
          else
          {
              $messages->addErrors($form->getErrorSchema()->getErrors());
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('users','ajaxDashboardList');   
    }

}