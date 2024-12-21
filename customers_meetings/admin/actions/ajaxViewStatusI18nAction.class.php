<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusViewForm.class.php";
 
class customers_meetings_ajaxViewStatusI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingStatusViewForm();
        $this->item=new CustomerMeetingStatusI18n($request->getPostParameter('CustomerMeetingStatusI18n'));        
   }

}

