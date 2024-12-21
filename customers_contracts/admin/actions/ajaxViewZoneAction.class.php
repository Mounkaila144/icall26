<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractZoneViewForm.class.php';

class customers_contracts_ajaxViewZoneAction extends mfAction{
    
    function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
        $this->item=new CustomerContractZone($request->getPostParameter('CustomerContractZone')); 
        $this->user=$this->getUser();
        $this->form=new CustomerContractZoneViewForm(); 
    }
}
