<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormForm.class.php";
 
class customers_meetings_forms_ajaxFormFieldsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
  
        
    function execute(mfWebRequest $request) {                     
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();        
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'),$this->site);     
        $this->form=new CustomerMeetingFormForm($this->item->getDefaultFormfields());           
        //var_dump($this->form); //->getWidgetForChoices());
   }

}

