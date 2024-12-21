<?php
require_once __DIR__."/../locales/Api/Forms/CreatePasswordUserApiForm.class.php";
require_once __DIR__."/../locales/Api/CreatePasswordUserFormatterApi.class.php";

class users_apiCreatePasswordUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                   
        $item=new User(null,'admin');  
        $form = new CreatePasswordUserApiForm($this->getUser()); 
        $data = new CreatePasswordUserFormatterApi($item,$form);                
        return $data->toArray();
    }

}
