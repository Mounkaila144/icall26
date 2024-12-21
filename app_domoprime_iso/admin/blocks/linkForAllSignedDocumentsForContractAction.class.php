<?php



class app_domoprime_iso_linkForAllSignedDocumentsForContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_view_all_signed_documents'))))
                return mfView::NONE;              
    } 
    
    
}