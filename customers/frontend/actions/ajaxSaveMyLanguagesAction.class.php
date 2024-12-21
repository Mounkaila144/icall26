<?php

require_once dirname(__FILE__)."/../locales/Forms/MyLanguagesForm.class.php";

class customers_ajaxSaveMyLanguagesAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();      
        $this->form=new MyLanguagesForm($this->user,$request->getPostParameter('CustomerUserLanguage'));
        $this->form->bind($request->getPostParameter('CustomerUserLanguage'));
        if ($this->form->isValid())
        {
            $this->user->getGuardUser()->updateLanguages($this->form->getValue('languages'));
            $messages->addInfo(__("Languages have been updated."));
          //  $this->forward('customers','ajaxListPartialCustomer');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
          //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
        }    
        
    }
    
}