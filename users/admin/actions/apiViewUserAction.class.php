<?php

// www.ecosol28.net/admin/api/users/admin/ViewUser
require_once __DIR__."/../locales/Api/Forms/UserApiForm.class.php";
require_once __DIR__."/../locales/Api/UserViewFormatterApi.class.php";

class users_apiViewUserAction extends mfAction {
               
    function execute(mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                   
        $item=new User($request->getPostParameter('User'),'admin');  
        
        // var_dump($request->getSite()->getTheme());  die(__METHOD__);
        $form = new UserApiForm($this->getUser());                    
        $data = new UserViewFormatterApi($item,$form);     
        $this->getEventDispather()->notify(new mfEvent($data, 'api.user.view')); 
        return $data->toArray();
    }

}

 