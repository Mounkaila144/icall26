<?php



class app_domoprime_iso_linkForPdfDocumentsForContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_view_pdf_documents'))))
                return mfView::NONE;        
       // $this->contract=$this->getParameter('contract'); 
        
    } 
    
    
}