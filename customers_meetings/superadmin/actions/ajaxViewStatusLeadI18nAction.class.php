<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusLeadViewForm.class.php";
 
class customers_meetings_ajaxViewStatusLeadI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingStatusLeadViewForm();
        $this->item=new CustomerMeetingStatusLeadI18n($request->getPostParameter('CustomerMeetingStatusLeadI18n'),$this->site);        
   }

}

