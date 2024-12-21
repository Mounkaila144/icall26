<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingTypeNewForm.class.php";

class customers_meetings_ajaxNewTypeI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialType');  
        }       
        $this->form= new CustomerMeetingTypeNewForm((string)$form['lang']);
        $this->type_i18n=new CustomerMeetingTypeI18n(array('lang'=>(string)$form['lang']));        
    }

}
