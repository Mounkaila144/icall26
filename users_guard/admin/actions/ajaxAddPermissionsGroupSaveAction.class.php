<?php


class users_guard_ajaxAddPermissionsGroupSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();     
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_permissions_add'))))
            $this->forwardTo401Action ();
         try 
      {
          $form=new AddPermissionsGroupForm($request->getPostParameter('permissions'),'admin');
          $form->bind($request->getPostParameter('permissions'));
          if ($form->isValid())
          {
              $group=new Group($form->getValue('group_id'),'admin');
              if ($group->isLoaded())
              {   
                $groupPermissions = new GroupPermissionCollection($form->getValue('permissions'));  
                $groupPermissions->save();
                $messages->addInfo(__("Permissions added on group [%s].",(string)$group));
                $request->addRequestParameter('group', $group);  
                $this->getEventDispather()->notify(new mfEvent($groupPermissions,'user.group.permission.add',array('group'=>$group)));
                $this->forward('users_guard','ajaxListPermissionsGroup');   
              }  
          }    
        else {
            $messages->addError(__("Forms has some errors."));
        }
             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('users_guard','ajaxListPartialGroup');   
      return mfView::NONE;
    }

}