<?php
require_once dirname(__FILE__).'/../locales/Forms/RegistrationNewForm.class.php';

class utils_registration_ajaxNewRegistrationAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();

        try
        {
            $item=new UtilsRegistration();
            $this->item=$item->generate();              
            if ($this->item->isExist())
                throw new mfException(__("Registration already exists."));
            $this->item->save();
            $messages->addInfo(__("Registration has been created"));
            $this->forward('utils_registration','ajaxListRegistration');                   
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}
