<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingTypeViewForm.class.php";
 
class customers_meetings_ajaxViewTypeI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingTypeViewForm();
        $this->item=new CustomerMeetingTypeI18n($request->getPostParameter('CustomerMeetingTypeI18n'));        
   }

}

