<?php



class app_domoprime_iso_documentForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                      
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_contract_view_document'))))  
                return mfView::NONE;
        $this->engine= new DomoprimeIsoDocumentEngine($this->getParameter('contract'));
        $this->engine->process();
    } 
    
    
}