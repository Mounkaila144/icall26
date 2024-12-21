<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelPdfImportArchiveForPolluterForm.class.php";

 
class partners_polluter_ajaxImportPDFArchiveForPolluterAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();        
        $this->form = new PartnerPolluterModelPdfImportArchiveForPolluterForm();
        $this->item=new PartnerPolluterCompany($request->getPostParameter('Polluter'));               
   }

}

