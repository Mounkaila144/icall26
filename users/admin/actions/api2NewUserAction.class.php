<?php
// www.ecosol16.net/admin/api/v2/users/admin/NewUser

require_once __DIR__."/../locales/Api/2/Forms/UserApi2NewForm.class.php";
require_once __DIR__."/../locales/Api/2/UserNewFormatterApi2.class.php";

class users_api2NewUserAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_settings_user_new'))))
              $this->forwardTo401Action();
        $form = new UserApi2NewForm($this->getUser());                                   
        $form->bind($request->getPostParameters());    
        if ($form->isValid())
            return $form->getData()->toArray();    
        if (!$form->getNotCheckedValues())
             return array('errors'=>array('code'=>1,'text'=>'Data is empty'));
        return array('errors'=>$form->getErrorSchema()->getErrorsMessage()); 
    }

}
