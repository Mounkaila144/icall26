<?php
// www.ecosol34.net/admin/api/users/admin/ListUser
// https://theme34n.icall26.net/admin/api/users/admin/ListUser?token

require_once __DIR__."/../locales/Api/FormFilters/UsersApiFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/UserPager.class.php";
require_once __DIR__."/../locales/Api/UserListFormatterApi.class.php";

class users_apiListUserAction extends mfAction {

    function execute(mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();          
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin','settings_user_list'))))
            $this->forwardTo401Action();                         
         $data = new UserListFormatterApi($this);               
         return $data->toArray();
    }

}