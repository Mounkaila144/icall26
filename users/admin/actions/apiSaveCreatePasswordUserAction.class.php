<?php
require_once __DIR__."/../locales/Api/Forms/CreatePasswordUserApiForm.class.php";
require_once __DIR__."/../locales/Api/UserSaveCreatePasswordFormatterApi.class.php";

class users_apiSaveCreatePasswordUserAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();        
        $form = new CreatePasswordUserApiForm($this->getUser());           
        $item=new User($request->getPostParameter('User'),'admin');                   
        $form->bind($request->getPostParameter('User'));           
        $data = new UserSaveCreatePasswordFormatterApi($item, $form);               
        return $data->toArray();
    }

}
