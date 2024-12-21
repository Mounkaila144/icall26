<?php

class app_domoprime_quotationFilterContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        if (!$this->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_contract_list_has_quotation'))))
             return mfView::NONE;
    } 
    
    
}
