<?php
require_once __DIR__."/../locales/Api/UserViewProfileFormatterApi.class.php";

class users_apiViewProfileAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $data = new UserViewProfileFormatterApi($this->getUser()->getGuardUser()); 
        return $data->toArray();
    }

}
