<?php

require_once dirname(__FILE__)."/../locales/Api/Forms/UserApiViewProfileForm.class.php";
require_once __DIR__."/../locales/Api/UserViewUserProfileFormatterApi.class.php";

class users_apiViewUserProfileAction extends mfAction{
    
    public function execute(\mfWebRequest $request) { 
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();     
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_profile_view'))))
        $this->forwardTo401Action();
        $item=new User($request->getPostParameter('User'),'admin');  
        // var_dump($request->getSite()->getTheme());  die(__METHOD__);
        $form = new UserApiViewProfileForm($item,$this->getUser());                    
        $data = new UserViewUserProfileFormatterApi($item,$form);     
        $this->getEventDispather()->notify(new mfEvent($data, 'api.user.view')); 
        return $data->toArray();
    }

}
