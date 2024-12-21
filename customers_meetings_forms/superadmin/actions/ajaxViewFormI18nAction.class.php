<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormViewForm.class.php";
 
class customers_meetings_forms_ajaxViewFormI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
  
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingFormViewForm();
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'),$this->site);        
   }

}

