<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusLeadNewForm.class.php";

class customers_meetings_ajaxNewStatusLeadI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");      
        $form=new LanguageFrontendForm($this->getUser()->getCountry(),$this->site);
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_meetings','ajaxListPartialStatusLead');  
        }       
        $this->form= new CustomerMeetingStatusLeadNewForm((string)$form['lang'],array(),$this->site);
        $this->customer_contract_status_i18n=new CustomerMeetingStatusLeadI18n(array('lang'=>(string)$form['lang']),$this->site);        
    }

}
