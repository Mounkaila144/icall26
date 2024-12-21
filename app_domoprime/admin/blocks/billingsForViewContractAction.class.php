<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeBillingForContractFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeBillingForContractPager.class.php";


class app_domoprime_billingsForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();       
        $contract=$this->getParameter('contract');
        if ($contract->isNotLoaded())
            return ;
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_view_billings'))))  
                return mfView::NONE;            
         $this->last_billing=new DomoprimeBilling($contract);
    } 
    
    
}