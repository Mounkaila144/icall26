<?php

class users_guard_ajaxDashboardAddPermissionsGroupSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();     
        try 
      {
          $form=new addPermissionsGroupForm($request->getPostParameter('permissions'));
          $form->bind($request->getPostParameter('permissions'));
          if ($form->isValid())
          {
              $group=new group($form->getValue('group_id'));
              if ($group->isLoaded())
              {   
                $groupPermissions = new GroupPermissionCollection($form->getValue('permissions'));  
                $groupPermissions->save();
                $messages->addInfo(__("Permissions added on group [%s].",$group->get('name')));
                $request->addRequestParameter('group', $group);
                $this->forward('users_guard','ajaxDashboardListPermissionsGroup');   
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
      $this->forward('users_guard','ajaxDashboardListGroups');   
    }

}