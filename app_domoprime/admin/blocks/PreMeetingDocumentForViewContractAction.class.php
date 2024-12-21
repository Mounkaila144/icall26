<?php



class app_domoprime_PreMeetingDocumentForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         //$contract=$this->getParameter('contract');
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_view_premeeting_document'))))  
                return mfView::NONE;
    } 
    
    
}