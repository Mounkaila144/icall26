<?php



class app_domoprime_iso_linkForDocumentForContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_document'))))
                return mfView::NONE;
        $contract=$this->getParameter('contract');
        if (!$contract->hasCalculation())
            return mfView::NONE;
        $this->contract=$this->getParameter('contract'); 
        
    } 
    
    
}