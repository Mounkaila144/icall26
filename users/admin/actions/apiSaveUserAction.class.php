<?php

// www.ecosol28.net/admin/api/users/admin/SaveUser

require_once __DIR__."/../locales/Api/Forms/UserApiForm.class.php";
require_once __DIR__."/../locales/Api/UserSaveViewFormatterApi.class.php";

class users_apiSaveUserAction extends mfAction {
    
           
    function execute(mfWebRequest $request) { 
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();        
        $form = new UserApiForm($this->getUser());           
        $item=new User($request->getPostParameter('User'),'admin');                   
        $form->bind($request->getPostParameter('User'));           
        $data = new UserSaveViewFormatterApi($item,$form);               
        return $data->toArray();
    }
}
  