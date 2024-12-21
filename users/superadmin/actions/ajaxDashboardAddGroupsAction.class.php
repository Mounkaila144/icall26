<?php


class users_ajaxDashboardAddGroupsAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();      
        $this->user=new User($request->getPostParameter('user'));
        $this->groups=UserGroupUtils::getGroupsUserList($this->user);    
    }

}