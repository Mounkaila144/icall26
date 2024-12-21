<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerMeetingCompanyForm.class.php';

class customers_Meetings_ajaxViewCompanyAction extends mfAction{
    
    function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
        $this->item=new CustomerMeetingCompany($request->getPostParameter('CustomerMeetingCompany')); 
        $this->user=$this->getUser();
        $this->form=new CustomerMeetingCompanyForm($this->getUser()); 
    }
}
