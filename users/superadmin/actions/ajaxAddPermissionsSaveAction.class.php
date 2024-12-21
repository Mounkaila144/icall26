<?php

require_once dirname(__FILE__)."/../locales/Forms/AddPermissionsUserForm.class.php";


class users_ajaxAddPermissionsSaveAction  extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();   
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);               
       try 
       {
          $form=new AddPermissionsUserForm($request->getPostParameter('Permissions'),'admin',$this->site);          
          $form->bind($request->getPostParameter('Permissions'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user_id'),'admin',$this->site);
              if ($user->isLoaded())
              {   
                $userPermissions = new UserPermissionCollection($form->getValue('permissions'),$this->site);  
                $userPermissions->save();
                $messages->addInfo(__("Permissions added on user [%s].",(string)$user));
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