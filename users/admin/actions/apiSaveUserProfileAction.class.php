<?php
require_once __DIR__."/../locales/Api/Forms/UserApiViewProfileForm.class.php";
require_once __DIR__."/../locales/Api/UserSaveViewProfileFormatterApi.class.php";

class users_apiSaveUserProfileAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();  
        $item=new User($request->getPostParameter('User'),'admin'); 
        $form = new UserApiViewProfileForm($item,$this->getUser());                             
        $form->bind($request->getPostParameter('User'));           
        $data = new UserSaveViewProfileFormatterApi($item,$form);               
        return $data->toArray();
    }

}
