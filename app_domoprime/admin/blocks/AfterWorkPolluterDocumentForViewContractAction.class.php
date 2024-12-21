<?php



class app_domoprime_AfterWorkPolluterDocumentForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         //$contract=$this->getParameter('contract');
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_view_afterwork_document'))))  
                return mfView::NONE;
    } 
    
    
}