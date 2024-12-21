<?php
// www.ecosol16.net/admin/api/v2/users/admin/ListTeamUser

 
class users_api2ListTeamUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');     
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_settings_user_team_list'))))
            $this->forwardTo401Action();    
        return UserTeamUtils::getFieldValues2ForSelect('name')->unshift(array(0=>__("No team")))->toArray();
    }

}
