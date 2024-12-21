<?php

require_once dirname(__FILE__)."/../locales/Forms/AddUserGroupsForm.class.php";

class users_ajaxAddGroupsSaveAction  extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();  
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
      try 
      {
          $form=new AddUserGroupsForm($request->getPostParameter('Groups'),'admin',$this->site);
          $form->bind($request->getPostParameter('Groups'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user_id'),'admin',$this->site);
              if ($user->isLoaded())
              {   
                $userGroups = new UserGroupCollection($form->getValue('groups'),$this->site);  
                $userGroups->save();
                $messages->addInfo(__("Groups added on user [%s].",(string)$user));
                $request->addRequestParameter('User', $user);
                $this->forward('users','ajaxGroupsList');   
              }  
          }    
          else
          {
            //  var_dump($form->getErrorSchema());
              $messages->addError(__("Form has some errors."));
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('users','ajaxList');  
    }

}