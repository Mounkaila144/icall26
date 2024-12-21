<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusNewForm.class.php";

class customers_meetings_ajaxNewStatusI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialStatus');  
        }       
        $this->form= new CustomerMeetingStatusNewForm((string)$form['lang']);
        $this->customer_contract_status_i18n=new CustomerMeetingStatusI18n(array('lang'=>(string)$form['lang']));        
    }

}
