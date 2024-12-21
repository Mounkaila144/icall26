<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractCompanyForm.class.php';

class customers_contracts_ajaxViewCompanyAction extends mfAction{
    
    function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
        $this->item=new CustomerContractCompany($request->getPostParameter('CustomerContractCompany')); 
        $this->user=$this->getUser();
        $this->form=new CustomerContractCompanyForm($this->getUser()); 
    }
}
