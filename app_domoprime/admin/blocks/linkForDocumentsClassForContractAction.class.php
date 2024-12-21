<?php

class app_domoprime_linkForDocumentsClassForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->contract=$this->getParameter('contract') ;
        $this->user=$this->getUser(); 
        if (!$this->getUser()->hasCredential(array(array('superadmin','contract_documents_form_list_class'))))
           return mfView::NONE;
    } 
    
    
}