<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusNewForm.class.php";

class customers_meetings_ajaxNewStatusI18nAction extends mfAction {
    
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
            $this->forward('customers_meetings','ajaxListPartialStatus');  
        }       
        $this->form= new CustomerMeetingStatusNewForm((string)$form['lang'],array(),$this->site);
        $this->customer_contract_status_i18n=new CustomerMeetingStatusI18n(array('lang'=>(string)$form['lang']),$this->site);        
    }

}
