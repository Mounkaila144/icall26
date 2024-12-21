<?php


class users_ajaxDashboardAddGroupPermissionsSaveAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();     
        if ($request->getPostParameter('selection')) {
              $group=new Group($request->getPostParameter('group'));
              $permissionsValidator = new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices" => groupPermissionUtils::getPermissionsAllowedGroupList($group))), count($request->getPostParameter('selection')));
              try {
                $permissions=$permissionsValidator->isValid($request->getPostParameter('selection'));
                $groupPermissions = new GroupPermissionCollection(array('permission_id'=>$permissions));
                $groupPermissions->setParameters($group);
                $groupPermissions->save();
                $messages->addInfo(__("permissions added"));
                $this->forward('users','ajaxDashboardAllPermissionsList');
              }
              catch (mfValidatorErrorSchema $e) {
                $messages->addErrors(array_merge($e->getGlobalErrors(), $e->getErrors()));               
              }
        }
        $this->forward('users','ajaxDashboardAddGroupPermissions');
        return mfView::NONE;
    }

}