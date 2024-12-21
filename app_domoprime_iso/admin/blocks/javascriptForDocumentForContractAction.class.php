<?php



class app_domoprime_iso_javascriptForDocumentForContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_document'))))
                return mfView::NONE;
        
    } 
    
    
}