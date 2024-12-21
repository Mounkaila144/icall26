<?php
// www.ecosol28.net/admin/api/users/admin/SaveNewUser
require_once __DIR__."/../locales/Api/Forms/UserApiNewForm.class.php";
require_once __DIR__."/../locales/Api/UserSaveNewFormatterApi.class.php";

class users_apiSaveNewUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();        
        $form = new UserApiNewForm($this->getUser());           
        $item=new User(null,'admin');                   
        $form->bind($request->getPostParameter('User'));           
        $data = new UserSaveNewFormatterApi($item, $form);               
        return $data->toArray();
    }

}
