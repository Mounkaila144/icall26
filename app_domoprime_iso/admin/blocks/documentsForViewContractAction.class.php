<?php



class app_domoprime_iso_documentsForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                         
        if (!$this->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_view_documents'))))  
                return mfView::NONE;
    } 
    
    
}