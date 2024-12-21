<?php


class users_ajaxDashboardAddUserPermissionsSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();     
    /*    if ($request->getPostParameter('selection')) {
              $user=new User($request->getPostParameter('user'));
              $permissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => userPermissionUtils::getPermissionsAllowedUserList($user))), 
                                                                   count($request->getPostParameter('selection')));
              try {
                $permissions=$permissionsValidator->isValid($request->getPostParameter('selection'));
                $userPermissions = new UserPermissionCollection(array('permission_id'=>$permissions));
                $userPermissions->setParameters($user);
                $userPermissions->save();
                $messages->addInfo(__("permissions added"));
                $this->forward('users','ajaxDashboardAllPermissionsList');
              }
              catch (mfValidatorErrorSchema $e) {
                $messages->addErrors(array_merge($e->getGlobalErrors(), $e->getErrors()));               
              }
        }
        $this->forward('users','ajaxDashboardAddUserPermissions');*/
        echo "IIC";
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
                $messages->addInfo(__("permissions added on group [%s].",$group));
                $request->addRequestParameter('group', $group);
            //    $this->forward('userGuard','ajaxDashboardGroupsPermissionsList');   
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
   //   $this->forward('userGuard','ajaxDashboardGroupsList');   
        return mfView::NONE;
    }

}