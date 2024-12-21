<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusCallNewForm.class.php";

class customers_meetings_ajaxNewStatusCallI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialStatusCall');  
        }       
        $this->form= new CustomerMeetingStatusCallNewForm((string)$form['lang']);
        $this->customer_contract_status_i18n=new CustomerMeetingStatusCallI18n(array('lang'=>(string)$form['lang']));        
    }

}
