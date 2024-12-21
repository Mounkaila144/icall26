<?php

require_once dirname(__FILE__)."/../locales/Forms/AddPermissionsUserForm.class.php";


class users_ajaxAddPermissionsSaveAction  extends mfAction {
    
  
     function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();   
       if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_permissions_user_add'))))
            $this->forwardTo401Action();
       try 
       {
          $form=new AddPermissionsUserForm($request->getPostParameter('permissions'),'admin');          
          $form->bind($request->getPostParameter('permissions'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user_id'),'admin',$this->site);
              if (!$user->isAuthorized('permission_add'))
                    $this->forwardTo401Action();  
              if ($user->isLoaded())
              {   
                $userPermissions = new UserPermissionCollection($form->getValue('permissions'));  
                $userPermissions->save();
                $messages->addInfo(__("Permissions added on user [%s].",(string)$user));
                $this->getEventDispather()->notify(new mfEvent($userPermissions,'user.permission.add',array('user'=>$user)));
                $request->addRequestParameter('User', $user);
                $this->forward('users','ajaxPermissionsList');   
              }  
          }             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('users','ajaxList');   
    }

}