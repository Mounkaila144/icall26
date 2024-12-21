<?php
// www.ecosol26.net/admin/api/users/admin/NewUser

require_once __DIR__."/../locales/Api/Forms/UserApiNewForm.class.php";
require_once __DIR__."/../locales/Api/UserNewFormatterApi.class.php";

class users_apiNewUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                   
        $item=new User(null,'admin');  
        $form = new UserApiNewForm($this->getUser()); 
        $data = new UserNewFormatterApi($item,$form);                
        return $data->toArray();
        
    }

}
