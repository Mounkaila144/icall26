<?php
require_once __DIR__."/../locales/Api/Forms/UserProfileApiNewForm.class.php";
require_once __DIR__."/../locales/Api/UserProfileNewFormatterApi.class.php";

class users_apiNewUserProfileAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                   
        $item=new User(null,'admin');  
        $form = new UserProfileApiNewForm($this->getUser()); 
        $data = new UserProfileNewFormatterApi($item,$form);                
        return $data->toArray();
        
    }

}
