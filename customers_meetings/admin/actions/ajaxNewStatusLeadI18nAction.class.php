<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusLeadNewForm.class.php";

class customers_meetings_ajaxNewStatusLeadI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialStatusLead');  
        }       
        $this->form= new CustomerMeetingStatusLeadNewForm((string)$form['lang']);
        $this->customer_contract_status_i18n=new CustomerMeetingStatusLeadI18n(array('lang'=>(string)$form['lang']));        
    }

}
