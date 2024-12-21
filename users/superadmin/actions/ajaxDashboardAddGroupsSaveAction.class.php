<?php

require_once dirname(__FILE__)."/../locales/Forms/AddUserGroupsForm.class.php";

class users_ajaxDashboardAddGroupsSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();    
      try 
      {
          $form=new AddUserGroupsForm($request->getPostParameter('groups'));
          $form->bind($request->getPostParameter('groups'));
          if ($form->isValid())
          {
              $user=new User($form->getValue('user_id'));
              if ($user->isLoaded())
              {   
                $userGroups = new UserGroupCollection($form->getValue('groups'));  
                $userGroups->save();
                $messages->addInfo(__("Groups added on user [%s].",$user));
                $request->addRequestParameter('user', $user);
                $this->forward('users','ajaxDashboardGroupsList');   
              }  
          }    
          else
          {
              $messages->addErrors(__("Forms has some errors."));
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('users','ajaxDashboardList');  
    }

}