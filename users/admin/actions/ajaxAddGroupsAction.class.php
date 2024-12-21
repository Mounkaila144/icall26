<?php


class users_ajaxAddGroupsAction  extends mfAction {
    
     
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();            
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_groups_add'))))
            $this->forwardTo401Action();
        $this->user=new User($request->getPostParameter('User'),'admin');
        $this->groups=UserGroupUtils::getGroupsUserList($this->user,$this->getUser());    
    }

}